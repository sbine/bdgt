<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use OfxParser\Parser;

class Import extends Command
{
    protected $signature = 'import {user} {path}';

    protected $description = "Imports a user's OFX file into the system";

    public function handle()
    {
        $userArg = $this->argument('user');
        $pathArg = $this->argument('path');

        // Ensure the user is valid
        $user = is_numeric($userArg) ? User::find($userArg) : User::where('email', $userArg)->first();
        if (! $user) {
            $this->error(sprintf('User not found: %s', $userArg));

            return 1;
        }

        // Ensure the file path is valid
        if (! file_exists($pathArg) || pathinfo($pathArg, PATHINFO_EXTENSION) != 'ofx') {
            $this->error(sprintf('Invalid file: %s', $pathArg));

            return 1;
        }

        if (! $this->confirm(sprintf('Import %s for user %s?', $pathArg, $user->email))) {
            return 1;
        }

        $ofx = (new Parser)->loadFromFile($pathArg);

        foreach ($ofx->bankAccounts as $accountData) {
            $matchingAccount = $user->accounts()->where('name', 'LIKE', $accountData->accountType)->first();

            if (! $matchingAccount) {
                $this->info(sprintf('Skipping missing account: %s', $accountData->accountType));

                continue;
            }

            foreach ($accountData->statement->transactions as $ofxEntity) {
                $ofxEntityArr = [
                    'user_id' => $user->id,
                    'date' => $ofxEntity->date,
                    'amount' => abs($ofxEntity->amount),
                    'payee' => $ofxEntity->name,
                    'account_id' => $matchingAccount->id,
                    'inflow' => $ofxEntity->type === 'CREDIT',
                    'cleared' => 0,
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
                    $this->error(sprintf('Invalid file: %s', $pathArg));

                    return 2;
                }

                Transaction::create($ofxEntityArr);
            }
        }

        $this->info('OFX file successfully imported!');

        return 0;
    }
}
