<?php

namespace Bdgt\Http\Composers;

use Illuminate\Contracts\View\View;
use Bdgt\Repositories\Contracts\AccountRepositoryInterface;

class AccountsComposer
{
    protected $accountRepository;

    /**
     * Create a new composer.
     *
     * @return void
     */
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $accounts = $this->accountRepository->all();

        $view->with(['accounts' => $accounts]);
    }
}
