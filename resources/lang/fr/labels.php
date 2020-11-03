<?php

return [
    'main' => [
        'home' => 'Accueil',
    ],
    'modals' => [
        'button_close' => 'Annuler',
    ],
    'emails' => [
        'forgot_password_text' => 'Cliquez ici pour réinitialiser votre mot de passe:',
    ],
    'auth' => [
        'sign_in' => 'Se connecter',
        'login' => 'S\'identifier',
        'logout' => 'Se déconnecter',
        'register' => 'S\'inscrire',
        'register_button' => 'S\'inscrire maintenant',
        'forgot_password' => 'Mot de passe oublié?',
        'reset_password' => 'Réinitialiser le mot de passe',
        'send_password_reset_link' => 'Envoyer le lien de réinitialisation du mot de passe',
        'properties' => [
            'username' => 'Nom d\'utilisateur',
            'email' => 'Adresse Email',
            'password' => 'Mot de passe',
            'password_confirmation' => 'Confirmez le mot de passe',
            'remember' => 'Souviens-toi de moi',
        ],
    ],
    'dashboard' => [
        'singular' => 'Dashboard',
        'properties' => [
            'current_balance' => 'Solde actuel',
            'last_purchase' => 'Dernière achat',
            'next_Facture' => 'Prochaine facture',
            'planned_features' => 'Fonctionnalités prévues',
            'zero_based_budgeting' => [
                'title' => 'Budget basé sur zéro',
                'description' => 'Budget à zéro en utilisant la méthode de l\'enveloppe pour garder vos dépenses sous contrôle. Consultez vos catégories pour guider vos décisions d\'achat.'
            ],
            'automatic_Facture_reminders' => [
                'title' => 'Rappels automatiques des faits',
                'description' => 'Receive email and push notifications when due dates approach for unpaid Factures. Never miss a payment again.'
            ],
            'goal_tracking' => [
                'title' => 'Suivi des objectifs',
                'description' => 'Achieve your goals with bdgt goal tracking. Painlessly Sauvegarder your way to every milestone.'
            ],
            'interactive_reports' => [
                'title' => 'Rapports interactifs',
                'description' => "Accédez à tout moment à vos données historiques grâce aux rapports complets de bdgt. La connaissance, c'est le pouvoir - analysez les tendances passées pour mieux planifier votre avenir."
            ],
        ]
    ],
    'accounts' => [
        'singular' => 'Compte',
        'plural' => 'Comptes',
        'add_button' => 'Ajouter un compte',
        'edit_button' => 'Éditer un compte',
        'delete_button' => 'Supprimer ce compte',
        'properties' => [
            'date_opened' => 'Date d\'ouverture',
            'name' => 'Nom',
            'balance' => 'Balance',
            'interest' => 'Taux d\'intérêt',
            'interest_period' => 'Période d\'intérêt',
        ],
        'modals' => [
            'create' => [
                'title' => 'Ajouter un compte',
                'close_button' => 'Annuler',
                'save_button' => 'Sauvegarder',
            ],
            'edit' => [
                'title' => 'Éditer ce compte',
                'close_button' => 'Annuler',
                'save_button' => 'Éditer',

            ],
            'delete' => [
                'title' => 'Supprimer ce compte',
                'close_button' => 'Annuler',
                'save_button' => 'Supprimer',
                'text' => 'Êtes-vous sûr de vouloir supprimer ce compte? Cette opération ne peut pas être annulée.',
            ],
        ],
    ],
    'bills' => [
        'singular' => 'Facture',
        'plural' => 'Factures',
        'add_button' => 'Ajouter une facture',
        'edit_button' => 'Éditer une dacture',
        'delete_button' => 'Supprimer cette Facture',
        'properties' => [
            'label' => 'Étiquette',
            'amount' => 'Montant',
            'start_date' => 'Date',
            'frequency' => 'Fréquence',
        ],
        'modals' => [
            'create' => [
                'title' => 'Ajouter une facture',
                'close_button' => 'Annuler',
                'save_button' => 'Sauvegarder',
            ],
            'edit' => [
                'title' => 'Éditer une facture',
                'close_button' => 'Annuler',
                'save_button' => 'Éditer',

            ],
            'delete' => [
                'title' => 'Supprimer une facture',
                'close_button' => 'Annuler',
                'save_button' => 'Supprimer',
                'text' => 'Voulez-vous vraiment supprimer cette facture? Cette opération ne peut pas être annulée.',
            ],
        ],
    ],
    'calculators' => [
        'singular' => 'Calculatrice',
        'plural' => 'Calculatrices',
        'debt' => [
            'label' => 'Calculateur de débit',
            'properties' => [
                'payment' => 'Paiement mensuel',
                'currentBalance' => 'Solde actuel',
                'interestRate' => 'Taux d\'intérêt',
                'minimumPayment' => 'Paiement minimum',
            ],
        ],
    ],
    'categories' => [
        'singular' => 'Catégorie',
        'plural' => 'Categories',
        'add_button' => 'Ajouter une Catégorie',
        'edit_button' => 'Éditer une catégorie',
        'delete_button' => 'Supprimer cette catégorie',
        'properties' => [
            'label' => 'Étiquette',
            'budgeted' => 'Budget Montant',
        ],
        'modals' => [
            'create' => [
                'title' => 'Ajouter une catégorie',
                'close_button' => 'Annuler',
                'save_button' => 'Sauvegarder',
            ],
            'edit' => [
                'title' => 'Éditer une catégorie',
                'close_button' => 'Annuler',
                'save_button' => 'Éditer',

            ],
            'delete' => [
                'title' => 'Supprimer une catégorie',
                'close_button' => 'Annuler',
                'save_button' => 'Supprimer',
                'text' => 'Êtes-vous sûr de vouloir supprimer cette catégorie? Cette opération ne peut pas être annulée.',
            ],
        ],
    ],
    'goals' => [
        'singular' => 'Objectif',
        'plural' => 'Objectifs',
        'add_button' => 'Ajouter un objectif',
        'edit_button' => 'Éditer un objectif',
        'delete_button' => 'Supprimer un objectif',
        'properties' => [
            'label' => 'Étiquette',
            'amount' => 'Objectif Montant',
            'balance' => 'Solde actuel',
            'goal_date' => 'Objectif Date',
        ],
        'modals' => [
            'create' => [
                'title' => 'Ajouter un objectif',
                'close_button' => 'Annuler',
                'save_button' => 'Sauvegarder',
            ],
            'edit' => [
                'title' => 'Éditer un objectif',
                'close_button' => 'Annuler',
                'save_button' => 'Éditer',

            ],
            'delete' => [
                'title' => 'Supprimer Objectif',
                'close_button' => 'Annuler',
                'save_button' => 'Supprimer',
                'text' => 'Voulez-vous vraiment supprimer cet objectif? Cette opération ne peut pas être annulée.',
            ],
        ],
    ],
    'reports' => [
        'singular' => 'Rapport',
        'plural' => 'Rapports',
        'spending_by_category' => 'Dépenses par catégorie',
        'spending_over_time' => 'Dépenses au fil du temps'
    ],
    'transactions' => [
        'singular' => 'Transaction',
        'plural' => 'Transactions',
        'add_button' => 'Ajouter une transaction',
        'export_button' => 'Export CSV',
        'edit_button' => 'Éditer une transaction',
        'delete_button' => 'Supprimer cette transaction',
        'properties' => [
            'date' => 'Date',
            'account_id' => 'Compte',
            'category_id' => 'Catégorie',
            'bill_id' => 'Facture',
            'payee' => 'Bénéficiaire',
            'amount' => 'Montant',
            'inflow' => 'Entrée',
            'outflow' => 'Sortie',
            'cleared' => 'Effacé',
            'flair' => 'Flair',
        ],
        'modals' => [
            'create' => [
                'title' => 'Ajouter une Transaction',
                'close_button' => 'Annuler',
                'save_button' => 'Sauvegarder',
            ],
            'edit' => [
                'title' => 'Éditer une transaction',
                'close_button' => 'Annuler',
                'save_button' => 'Éditer',

            ],
            'delete' => [
                'title' => 'Supprimer une transaction',
                'close_button' => 'Annuler',
                'save_button' => 'Supprimer',
                'text' => 'Êtes-vous sûr de vouloir supprimer cette transaction? Cette opération ne peut pas être annulée.',
            ],
        ],
    ],
];
