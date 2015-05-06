<?php namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\TransactionRepositoryInterface;
use Bdgt\Resources\Ledger;
use Bdgt\Resources\Account;
use Bdgt\Resources\Category;

use Input;
use Response;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->repository = $transactionRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $ledger = new Ledger($this->repository);

        $c['ledger'] = $ledger;

        $c['accounts'] = Account::all();

        $c['categories'] = Category::all();

        return view('transaction/index', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $ledger->transactions() ]);
    }

    /**
     * Create and store a new transaction.
     *
     * @return Redirect
     */
    public function store()
    {
        $transaction = Input::all();

        if ($this->repository->create($transaction)) {
            return Response::json(["status" => "success"]);
        }
        return Response::json(["status" => "error"]);
    }

    /**
     * Update an existing transaction with new data.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        $transaction = $this->repository->find($id);

        $transaction[Input::get('name')] = Input::get('value');

        if ($this->repository->update($transaction, $id)) {
            return Response::json(["status" => "success"]);
        }
        return Response::json(["status" => "error"]);
    }
}
