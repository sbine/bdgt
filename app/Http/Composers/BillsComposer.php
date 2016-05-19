<?php

namespace Bdgt\Http\Composers;

use Bdgt\Repositories\Contracts\BillRepositoryInterface;
use Illuminate\Contracts\View\View;

class BillsComposer
{
    protected $billRepository;

    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct(BillRepositoryInterface $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $bills = $this->billRepository->all();

        $view->with(['bills' => $bills]);
    }
}
