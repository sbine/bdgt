<?php

namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Input;

class BillController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BillRepositoryInterface $billRepository)
    {
        $this->repository = $billRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index()
    {
        $bills = $this->repository->all();

        $bills->sortBy(function ($bill) {
            return $bill->nextDue;
        });

        $c['bills'] = $bills;

        return view('bill.index', $c);
    }

    /**
     * Show an individual bill to the user.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $bill = $this->repository->find($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/bills');
        }

        $c['bill'] = $bill;

        return view('bill.show', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $bill->transactions ]);
    }

    /**
     * Create and store a new bill.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($bill = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect("/bills/{$bill->id}")->with('alerts.success', trans('crud.bills.created'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.bills.error'));
        }
    }

    /**
     * Update an existing bill with new data.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        if ($this->repository->update(Input::except(['_token', '_method']), $id)) {
            return redirect("/bills/{$id}")->with('alerts.success', trans('crud.bills.updated'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.bills.error'));
        }
    }

    /**
     * Delete a bill by ID.
     *
     * @param  int $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            return redirect("/bills")->with('alerts.success', trans('crud.bills.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.bills.error'));
        }
    }
}
