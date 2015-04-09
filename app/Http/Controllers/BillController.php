<?php namespace Bdgt\Http\Controllers;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Bdgt\Resources\Bill;

use Auth;
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
        //$this->middleware('auth');
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

        return view('bill/index', $c);
    }

    public function show($id)
    {
        try {
            $bill = $this->repository->find($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect('/bills');
        }

        $c['bill'] = $bill;

        return view('bill/show', $c)->nest('transactions', 'transaction._list', [ 'transactions' => $bill->transactions ]);
    }

    public function store()
    {
        if ($bill = $this->repository->create(Input::all())) {
            session()->flash('alerts.success', 'Bill created');
            return redirect("/bills/{$bill->id}");
        } else {
            session()->flash('alerts.danger', 'Bill creation failed');
            return redirect()->back();
        }
    }

    public function update($id)
    {
        if ($this->repository->update(Input::except(['_token', '_method']), $id)) {
            session()->flash('alerts.success', 'Bill updated');
            return redirect("/bills/{$id}");
        } else {
            session()->flash('alerts.danger', 'Bill update failed');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        if ($this->repository->delete($id)) {
            session()->flash('alerts.success', 'Bill deleted');
            return redirect("/bills");
        } else {
            session()->flash('alerts.danger', 'Bill deletion failed');
            return redirect()->back();
        }
    }
}
