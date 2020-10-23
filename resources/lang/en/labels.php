<?php

return [
    'main' => [
        'home' => 'Home',
    ],
    'modals' => [
        'button_close' => 'Cancel',
    ],
    'emails' => [
        'forgot_password_text' => 'Click here to reset your password:',
    ],
    'auth' => [
        'sign_in' => 'Sign In',
        'login' => 'Login',
        'logout' => 'Logout',
        'register' => 'Register',
        'register_button' => 'Register now',
        'forgot_password' => 'Forgot your password?',
        'reset_password' => 'Reset Password',
        'send_password_reset_link' => 'Send Password Reset Link',
        'properties' => [
            'username' => 'Username',
            'email' => 'Email Address',
            'password' => 'Password',
            'password_confirmation' => 'Confirm Password',
            'remember' => 'Remember Me',
        ],
    ],
    'dashboard' => [
        'singular' => 'Dashboard',
        'properties' => [
            'current_balance' => 'Current Balance',
            'last_purchase' => 'Last Purchase',
            'next_bill' => 'Next Bill',
            'planned_features' => 'Planned Features',
            'zero_based_budgeting' => [
                'title' => 'Zero-based Budgeting',
                'description' => 'Budget to zero using the envelope method to keep your spending in check. Consult your categories to help guide purchasing decisions.'
            ],
            'automatic_bill_reminders' => [
                'title' => 'Automatic Bill Reminders',
                'description' => 'Receive email and push notifications when due dates approach for unpaid bills. Never miss a payment again.'
            ],
            'goal_tracking' => [
                'title' => 'Goal Tracking',
                'description' => 'Achieve your goals with bdgt goal tracking. Painlessly save your way to every milestone.'
            ],
            'interactive_reports' => [
                'title' => 'Interactive Reports',
                'description' => "Access your historical data at any time through bdgt's comprehensive reports. Knowledge is power—analyze past trends to better plan for your future."
            ],
        ]
    ],
    'accounts' => [
        'singular' => 'Account',
        'plural' => 'Accounts',
        'add_button' => 'Add Account',
        'edit_button' => 'Edit Account',
        'delete_button' => 'Delete this account',
        'properties' => [
            'date_opened' => 'Date Opened',
            'name' => 'Name',
            'balance' => 'Balance',
            'interest' => 'Interest Rate',
            'interest_period' => 'Interest Period',
        ],
        'modals' => [
            'create' => [
                'title' => 'Add an Account',
                'close_button' => 'Cancel',
                'save_button' => 'Save',
            ],
            'edit' => [
                'title' => 'Edit Account',
                'close_button' => 'Cancel',
                'save_button' => 'Edit',

            ],
            'delete' => [
                'title' => 'Delete Account',
                'close_button' => 'Cancel',
                'save_button' => 'Delete',
                'text' => 'Are you sure you want to delete this account? This operation cannot be undone.',
            ],
        ],
    ],
    'bills' => [
        'singular' => 'Bill',
        'plural' => 'Bills',
        'add_button' => 'Add Bill',
        'edit_button' => 'Edit Bill',
        'delete_button' => 'Delete this bill',
        'properties' => [
            'label' => 'Label',
            'amount' => 'Amount',
            'start_date' => 'Date',
            'frequency' => 'Frequency',
        ],
        'modals' => [
            'create' => [
                'title' => 'Add a Bill',
                'close_button' => 'Cancel',
                'save_button' => 'Save',
            ],
            'edit' => [
                'title' => 'Edit Bill',
                'close_button' => 'Cancel',
                'save_button' => 'Edit',

            ],
            'delete' => [
                'title' => 'Delete Bill',
                'close_button' => 'Cancel',
                'save_button' => 'Delete',
                'text' => 'Are you sure you want to delete this bill? This operation cannot be undone.',
            ],
        ],
    ],
    'calculators' => [
        'singular' => 'Calculator',
        'plural' => 'Calculators',
        'debt' => [
            'label' => 'Debt Calculator',
            'properties' => [
                'payment' => 'Monthly Payment',
                'currentBalance' => 'Current Balance',
                'interestRate' => 'Interest Rate',
                'minimumPayment' => 'Minimum Payment',
            ],
        ],
    ],
    'categories' => [
        'singular' => 'Category',
        'plural' => 'Categories',
        'add_button' => 'Add Category',
        'edit_button' => 'Edit Category',
        'delete_button' => 'Delete this category',
        'properties' => [
            'label' => 'Label',
            'budgeted' => 'Budget Amount',
        ],
        'modals' => [
            'create' => [
                'title' => 'Add a Category',
                'close_button' => 'Cancel',
                'save_button' => 'Save',
            ],
            'edit' => [
                'title' => 'Edit Category',
                'close_button' => 'Cancel',
                'save_button' => 'Edit',

            ],
            'delete' => [
                'title' => 'Delete Category',
                'close_button' => 'Cancel',
                'save_button' => 'Delete',
                'text' => 'Are you sure you want to delete this category? This operation cannot be undone.',
            ],
        ],
    ],
    'goals' => [
        'singular' => 'Goal',
        'plural' => 'Goals',
        'add_button' => 'Add Goal',
        'edit_button' => 'Edit Goal',
        'delete_button' => 'Delete this goal',
        'properties' => [
            'label' => 'Label',
            'amount' => 'Goal Amount',
            'balance' => 'Current Balance',
            'goal_date' => 'Goal Date',
        ],
        'modals' => [
            'create' => [
                'title' => 'Add a Goal',
                'close_button' => 'Cancel',
                'save_button' => 'Save',
            ],
            'edit' => [
                'title' => 'Edit Goal',
                'close_button' => 'Cancel',
                'save_button' => 'Edit',

            ],
            'delete' => [
                'title' => 'Delete Goal',
                'close_button' => 'Cancel',
                'save_button' => 'Delete',
                'text' => 'Are you sure you want to delete this goal? This operation cannot be undone.',
            ],
        ],
    ],
    'reports' => [
        'singular' => 'Report',
        'plural' => 'Reports',
        'spending_by_category' => 'Spending By Category',
        'spending_over_time' => 'Spending Over Time',
    ],
    'transactions' => [
        'singular' => 'Transaction',
        'plural' => 'Transactions',
        'add_button' => 'Add Transaction',
        'export_button' => 'Export CSV',
        'edit_button' => 'Edit Transaction',
        'delete_button' => 'Delete this transaction',
        'properties' => [
            'date' => 'Date',
            'account_id' => 'Account',
            'category_id' => 'Category',
            'bill_id' => 'Bill',
            'payee' => 'Payee',
            'amount' => 'Amount',
            'inflow' => 'Inflow',
            'outflow' => 'Outflow',
            'cleared' => 'Cleared',
            'flair' => 'Flair',
        ],
        'modals' => [
            'create' => [
                'title' => 'Add a Transaction',
                'close_button' => 'Cancel',
                'save_button' => 'Save',
            ],
            'edit' => [
                'title' => 'Edit Transaction',
                'close_button' => 'Cancel',
                'save_button' => 'Edit',

            ],
            'delete' => [
                'title' => 'Delete Transaction',
                'close_button' => 'Cancel',
                'save_button' => 'Delete',
                'text' => 'Are you sure you want to delete this transaction? This operation cannot be undone.',
            ],
        ],
    ],
];
