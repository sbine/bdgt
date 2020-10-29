<?php

return [
    'main' => [
        'home' => 'Home',
    ],
    'modals' => [
        'button_close' => 'скасувати',
    ],
    'emails' => [
        'forgot_password_text' => 'натисніть тут щоб змінити свій пароль:',
    ],
    'auth' => [
        'sign_in' => 'Увійти',
        'login' => 'ввійти',
        'logout' => 'вийти',
        'register' => 'реєстрація',
        'register_button' => 'зареєструватися',
        'forgot_password' => 'забули пароль?',
        'reset_password' => 'скинути пароль',
        'send_password_reset_link' => 'надіслати посилання на скидання пароля',
        'properties' => [
            'username' => 'ім користувача',
            'email' => 'пошта',
            'password' => 'пароль',
            'password_confirmation' => 'підтвердіть пароль',
            'remember' => 'запам ятати мене',
        ],
    ],
    'dashboard' => [
        'singular' => 'Dashboard',
        'properties' => [
            'current_balance' => 'вже виплачено',
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
        'singular' => 'рахунок',
        'plural' => 'рахунки',
        'add_button' => 'додати рахунок',
        'edit_button' => 'редагувати рахунок',
        'delete_button' => 'вилучити рахунок',
        'properties' => [
            'date_opened' => 'дата відкриття',
            'name' => 'ім',
            'balance' => 'баланс',
            'interest' => 'відсоток',
            'interest_period' => 'процентний період',
        ],
        'modals' => [
            'create' => [
                'title' => 'додати рахунок',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'edit' => [
                'title' => 'редагувати рахунок',
                'close_button' => 'скасувати',
                'save_button' => 'редагувати',

            ],
            'delete' => [
                'title' => 'видалити рахунок',
                'close_button' => 'скасувати',
                'save_button' => 'вилучити',
                'text' => 'ви впевнені що хочете видалити цей рахунок? це операція незворотна. ',
            ],
        ],
    ],
    'bills' => [
        'singular' => 'регулярний платіж',
        'plural' => 'регулярні платежі',
        'add_button' => 'додати регулярний платіж',
        'edit_button' => 'редагувати регулярний платіж',
        'delete_button' => 'видалити регулярний платіж',
        'properties' => [
            'label' => 'назва',
            'amount' => 'сума',
            'start_date' => 'дата',
            'frequency' => 'частота',
        ],
        'modals' => [
            'create' => [
                'title' => 'створити регулярний платіж',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'edit' => [
                'title' => 'редагувати регулярний платіж',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'delete' => [
                'title' => 'видалити регулярний платіж',
                'close_button' => 'скасувати',
                'save_button' => 'вилучити',
                'text' => 'ви впевнені що хочете видалити цей регулярний платіж? ця операція незворотна. ',
            ],
        ],
    ],
    'calculators' => [
        'singular' => 'калькулятор',
        'plural' => 'калькулятори',
        'debt' => [
            'label' => 'калькулятор боргу',
            'properties' => [
                'payment' => 'місячний платіж',
                'currentbalance' => 'вже виплачено',
                'interestrate' => 'відсоткова ставка',
                'minimumpayment' => 'мінімальний платіж',
            ],
        ],
    ],
    'categories' => [
        'singular' => 'категорія',
        'plural' => 'категорії',
        'add_button' => 'додати категорію',
        'edit_button' => 'редагувати категорію',
        'delete_button' => 'вилучити категорію',
        'properties' => [
            'label' => 'назва',
            'budgeted' => 'ліміт бюджету',
        ],
        'modals' => [
            'create' => [
                'title' => 'додати категорію',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'edit' => [
                'title' => 'редагувати категорію',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',

            ],
            'delete' => [
                'title' => 'вилучити категорію',
                'close_button' => 'скасувати',
                'save_button' => 'вилучити',
                'text' => 'ви впевнені що хочете видалити цю категорію? ця операція незворотна. ',
            ],
        ],
    ],
    'goals' => [
        'singular' => 'мета',
        'plural' => 'цілі',
        'add_button' => 'додати мета',
        'edit_button' => 'редагувати мета',
        'delete_button' => 'видалити мета',
        'properties' => [
            'label' => 'назва',
            'amount' => 'сума мети',
            'balance' => 'поточний баланс',
            'goal_date' => 'дата цілі',
        ],
        'modals' => [
            'create' => [
                'title '=>' додати мета ',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'edit' => [
                'title' => 'редагувати мета',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'delete' => [
                'title' => 'видалити мета',
                'close_button' => 'скасувати',
                'save_button' => 'вилучити',
                'text' => 'ви впевнені що хочете видалити цю мету? ця операція незворотна. ',
            ],
        ],
    ],
    'reports' => [
        'singular' => 'звіт',
        'plural' => 'звіти',
        'spending_by_category' => 'витрати за категоріями',
        'spending_over_time' => 'витрати по часу',
    ],
    'transactions' => [
        'singular' => 'транзакція',
        'plural' => 'транзакції',
        'add_button' => 'додати транзакцію',
        'export_button' => 'Export CSV',
        'edit_button' => 'редагувати транзакцію',
        'delete_button' => 'видалити транзакцію',
        'properties' => [
            'date' => 'дата',
            'account_id' => 'рахунок',
            'category_id' => 'категорія',
            'bill_id' => 'регулярний платіж',
            'payee' => 'одержувач',
            'amount' => 'сума',
            'inflow' => 'прихід',
            'outflow' => 'витрата',
            'cleared' => 'проведена',
            'flair' => 'прапор',
        ],
        'modals' => [
            'create' => [
                'title' => 'додати транзакцію',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'edit' => [
                'title' => 'редагувати транзакцію',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
            ],
            'delete' => [
                'title' => 'видалити транзакцію',
                'close_button' => 'скасувати',
                'save_button' => 'зберегти',
                'text' => 'ви впевнені що хочете видалити цю транзакцію? ця операція незворотна. ',
            ],
        ],
    ],
];
