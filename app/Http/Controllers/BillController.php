<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BillRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;

class BillController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param BillRepositoryInterface $billRepository
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
        $bills = $this->repository->all()->sortBy(function ($bill) {
            return $bill->nextDue;
        });

        return view('bill.index', compact('bills'));
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
        } catch (ModelNotFoundException $e) {
            return redirect(route('bills.index'));
        }

        return view('bill.show', compact('bill'))->nest('transactions', 'transaction._list', [ 'transactions' => $bill->transactions ]);
    }

    /**
     * Create and store a new bill.
     *
     * @return Redirect
     */
    public function store()
    {
        if ($bill = $this->repository->create(Input::except(['_token', '_method']))) {
            return redirect(route('bills.show', $bill->id))->with('alerts.success', trans('crud.bills.created'));
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
            return redirect(route('bills.show', $id))->with('alerts.success', trans('crud.bills.updated'));
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
            return redirect(route('bills.index'))->with('alerts.success', trans('crud.bills.deleted'));
        } else {
            return redirect()->back()->with('alerts.danger', trans('crud.bills.error'));
        }
    }

    public function ajax_calendar_events()
    {
        $intervalStart = Input::get('start');
        $intervalEnd   = Input::get('end');

        $billsByDate = [];
        if ($intervalStart && $intervalEnd) {
            $bills = $this->repository->allForInterval($intervalStart, $intervalEnd);

            foreach ($bills as $bill) {
                $bill['title'] = $bill['label'] . ' due';
                $bill['url'] = '/bills/' . $bill['id'];
                $bill['start'] = $bill['start_date'];
                $bill['end'] = $bill['start_date'];
                $billsByDate[] = $bill;
            }
        }

        return response()->json($billsByDate);
    }
}
