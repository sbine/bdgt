<?php

namespace App\Console\Commands;

use OfxParser;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Validator;

class Import extends Command
{
    /**
     * The console command name.
     * @var string
     */
    protected $signature = 'import {user} {path}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Imports an OFX file into the system';

    /**
     * Execute the console command.
     * @return int
     */
    public function handle()
    {
        $userArg = $this->argument('user');
        $pathArg = $this->argument('path');

        // Ensure the user is valid
        $user = is_numeric($userArg) ? User::find($userArg) : User::where('email', $userArg)->first();
        if (!$user) {
            $this->output->writeln(sprintf('<error>Invalid User: %s</error>', $userArg));
            return 1;
        }

        // Ensure the file path is valid
        if (!file_exists($pathArg) || pathinfo($pathArg, PATHINFO_EXTENSION) != 'ofx') {
            $this->output->writeln(sprintf('<error>Invalid file: %s</error>', $pathArg));
            return 1;
        }

        $ofxParser = new OfxParser\Parser();
        $ofx = $ofxParser->loadFromFile($pathArg);

        foreach ($ofx->bankAccounts as $accountData) {
            $value = (string) $accountData->accountType;
            $matchingAccount = $user->accounts()->where('name', 'like', $value)->first();

            if ($matchingAccount) {
                foreach ($accountData->statement->transactions as $ofxEntity) {
                    $ofxEntityArr = [
                        'user_id' => $user->id,
                        'date' => $ofxEntity->date,
                        'amount' => $ofxEntity->amount,
                        'payee' => $ofxEntity->name,
                        'account_id' => $matchingAccount->id,
                        'inflow' => $ofxEntity->type == 'CREDIT'
                    ];

                    $validator = Validator::make($ofxEntityArr, [
                        'date' => 'required|date',
                        'amount' => 'required',
                        'payee' => 'required',
                        'account_id' => 'required|numeric',
                        'inflow' => 'required',
                        'category_id' => 'nullable|numeric',
                    ]);

                    if ($validator->fails()) {
                        $this->output->writeln(sprintf('<error>Invalid file: %s</error>', $pathArg));
                        return 2;
                    }

                    Transaction::create($ofxEntityArr);
                }
            }
        }

        $this->output->writeln('<info>OFX file successfully imported!</info>');
        return 0;
    }
}
