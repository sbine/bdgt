<?php

return [
    'modals' => [
        'button_close' => 'Отменить',
    ],
    'emails' => [
        'forgot_password_text' => 'Нажмите тут чтобы сменить свой пароль:',
    ],
    'auth' => [
        'login' => 'Войти',
        'logout' => 'Выйти',
        'register' => 'Регистрация',
        'register_button' => 'Зарегистрироваться',
        'forgot_password' => 'Забыли пароль?',
        'reset_password' => 'Сбросить пароль',
        'send_password_reset_link' => 'Отправить ссылку на сброс пароля',
        'properties' => [
            'username' => 'Имя пользователя',
            'email' => 'Почта',
            'password' => 'Пароль',
            'password_confirmation' => 'Подтвердите пароль',
            'remember' => 'Запомнить меня',
        ],
    ],
    'accounts' => [
        'singular' => 'Счет',
        'plural' => 'Счета',
        'add_button' => 'Добавить счет',
        'edit_button' => 'Редактировать счет',
        'delete_button' => 'Удалить счет',
        'properties' => [
            'date_opened' => 'Дата открытия',
            'name' => 'Имя',
            'balance' => 'Баланс',
            'interest' => 'Процент',
            'interest_period' => 'Процентный период',
        ],
        'modals' => [
            'create' => [
                'title' => 'Добавить счет',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'edit' => [
                'title' => 'Редактировать счет',
                'close_button' => 'Отменить',
                'save_button' => 'Редактировать',

            ],
            'delete' => [
                'title' => 'Удалить Счет',
                'close_button' => 'Отменить',
                'save_button' => 'Удалить',
                'text' => 'Вы уверены что хотите удалить этот счет? Это операция необратима.',
            ],
        ],
    ],
    'bills' => [
        'singular' => 'Регулярный платеж',
        'plural' => 'Регулярные платежи',
        'add_button' => 'Добавить регулярный платеж',
        'edit_button' => 'Редактировать регулярный платеж',
        'delete_button' => 'Удалить регулярный платеж',
        'properties' => [
            'label' => 'Название',
            'amount' => 'Сумма',
            'start_date' => 'Дата',
            'frequency' => 'Частота',
        ],
        'modals' => [
            'create' => [
                'title' => 'Создать регулярный платеж',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'edit' => [
                'title' => 'Редактировать регулярный платеж',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'delete' => [
                'title' => 'Удалить регулярный платеж',
                'close_button' => 'Отменить',
                'save_button' => 'Удалить',
                'text' => 'Вы уверены что хотите удалить этот регулярный платеж? Эта операция необратима.',
            ],
        ],
    ],
    'calculators' => [
        'singular' => 'Калькулятор',
        'plural' => 'Калькуляторы',
        'debt' => [
            'label' => 'Калькулятор долга',
            'properties' => [
                'payment' => 'Месячный платеж',
                'currentBalance' => 'Уже выплачено',
                'interestRate' => 'Процентная ставка',
                'minimumPayment' => 'Минимальный платеж',
            ],
        ],
    ],
    'categories' => [
        'singular' => 'Категория',
        'plural' => 'Категории',
        'add_button' => 'Добавить категорию',
        'edit_button' => 'Редактировать категорию',
        'delete_button' => 'Удалить категорию',
        'properties' => [
            'label' => 'Название',
            'budgeted' => 'Лимит бюджета',
        ],
        'modals' => [
            'create' => [
                'title' => 'Добавить категорию',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'edit' => [
                'title' => 'Редактировать категорию',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',

            ],
            'delete' => [
                'title' => 'Удалить категорию',
                'close_button' => 'Отменить',
                'save_button' => 'Удалить',
                'text' => 'Вы уверены что хотите удалить эту категорию? Эта операция необратима.',
            ],
        ],
    ],
    'goals' => [
        'singular' => 'Цель',
        'plural' => 'Цели',
        'add_button' => 'Добавить цель',
        'edit_button' => 'Редактировать цель',
        'delete_button' => 'Удалить цель',
        'properties' => [
            'label' => 'Название',
            'amount' => 'Сумма цели',
            'balance' => 'Текущий баланс',
            'goal_date' => 'Дата цели',
        ],
        'modals' => [
            'create' => [
                'title' => 'Добавить цель',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'edit' => [
                'title' => 'Редактировать цель',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'delete' => [
                'title' => 'Удалить цель',
                'close_button' => 'Отменить',
                'save_button' => 'Удалить',
                'text' => 'Вы уверены что хотите удалить эту цель? Эта операция необратима.',
            ],
        ],
    ],
    'reports' => [
        'singular' => 'Отчет',
        'plural' => 'Отчеты',
        'spending_by_category' => 'Траты по категориям',
        'spending_over_time' => 'Траты по времени',
    ],
    'transactions' => [
        'singular' => 'Транзакция',
        'plural' => 'Транзакции',
        'add_button' => 'Добавить транзакцию',
        'export_button' => 'Export Transaction',
        'edit_button' => 'Редактировать транзакцию',
        'delete_button' => 'Удалить транзакцию',
        'properties' => [
            'date' => 'Дата',
            'account_id' => 'Счет',
            'category_id' => 'Категория',
            'bill_id' => 'Регулярный платеж',
            'payee' => 'Получатель',
            'amount' => 'Сумма',
            'inflow' => 'Приход',
            'outflow' => 'Расход',
            'cleared' => 'Проведена',
            'flair' => 'Флаг',
        ],
        'modals' => [
            'create' => [
                'title' => 'Добавить транзакцию',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'edit' => [
                'title' => 'Редактировать транзакцию',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
            ],
            'delete' => [
                'title' => 'Удалить транзакцию',
                'close_button' => 'Отменить',
                'save_button' => 'Сохранить',
                'text' => 'Вы уверены что хотите удалить эту транзакцию? Эта операция необратима.',
            ],
        ],
    ],
];
