<?php

// resources/lang/fr/validation.php

return [
    'accepted' => 'Le champ :attribute doit être accepté.',
    'active_url' => 'Le champ :attribute n\'est pas une URL valide.',
    'after' => 'Le champ :attribute doit être une date après :date.',
    'after_or_equal' => 'Le champ :attribute doit être une date postérieure ou égale à :date.',
    'alpha' => 'Le champ :attribute ne doit contenir que des lettres.',
    'alpha_dash' => 'Le champ :attribute ne doit contenir que des lettres, des chiffres, des tirets et des underscores.',
    'alpha_num' => 'Le champ :attribute ne doit contenir que des lettres et des chiffres.',
    'array' => 'Le champ :attribute doit être un tableau.',
    'before' => 'Le champ :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale à :date.',
    'between' => [
        'array' => 'Le champ :attribute doit avoir entre :min et :max items.',
        'file' => 'Le champ :attribute doit être entre :min et :max kilobytes.',
        'numeric' => 'Le champ :attribute doit être entre :min et :max.',
        'string' => 'Le champ :attribute doit être entre :min et :max caractères.',
    ],
    'boolean' => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
    'date' => 'Le champ :attribute n\'est pas une date valide.',
    'date_equals' => 'Le champ :attribute doit être une date égale à :date.',
    'date_format' => 'Le champ :attribute ne correspond pas au format :format.',
    'different' => 'Le champ :attribute et :other doivent être différents.',
    'digits' => 'Le champ :attribute doit être :digits chiffres.',
    'digits_between' => 'Le champ :attribute doit être entre :min et :max chiffres.',
    'dimensions' => 'Le champ :attribute a des dimensions d\'image non valides.',
    'distinct' => 'Le champ :attribute a une valeur en double.',
    'email' => 'Le champ :attribute doit être une adresse email valide.',
    'ends_with' => 'Le champ :attribute doit se terminer par l\'une des valeurs suivantes : :values.',
    'exists' => 'Le champ :attribute sélectionné n\'est pas valide.',
    'file' => 'Le champ :attribute doit être un fichier.',
    'filled' => 'Le champ :attribute doit avoir une valeur.',
    'gt' => [
        'array' => 'Le champ :attribute doit avoir plus de :value items.',
        'file' => 'Le champ :attribute doit être supérieur à :value kilobytes.',
        'numeric' => 'Le champ :attribute doit être supérieur à :value.',
        'string' => 'Le champ :attribute doit être supérieur à :value caractères.',
    ],
    'gte' => [
        'array' => 'Le champ :attribute doit avoir au moins :value items.',
        'file' => 'Le champ :attribute doit être supérieur ou égal à :value kilobytes.',
        'numeric' => 'Le champ :attribute doit être supérieur ou égal à :value.',
        'string' => 'Le champ :attribute doit être supérieur ou égal à :value caractères.',
    ],
    'image' => 'Le champ :attribute doit être une image.',
    'in' => 'Le champ :attribute sélectionné n\'est pas valide.',
    'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
    'integer' => 'Le champ :attribute doit être un entier.',
    'ip' => 'Le champ :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le champ :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'Le champ :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le champ :attribute doit être une chaîne JSON valide.',
    'lt' => [
        'array' => 'Le champ :attribute doit avoir moins de :value items.',
        'file' => 'Le champ :attribute doit être inférieur à :value kilobytes.',
        'numeric' => 'Le champ :attribute doit être inférieur à :value.',
        'string' => 'Le champ :attribute doit être inférieur à :value caractères.',
    ],
    'lte' => [
        'array' => 'Le champ :attribute ne doit pas avoir plus de :value items.',
        'file' => 'Le champ :attribute doit être inférieur ou égal à :value kilobytes.',
        'numeric' => 'Le champ :attribute doit être inférieur ou égal à :value.',
        'string' => 'Le champ :attribute doit être inférieur ou égal à :value caractères.',
    ],
    'max' => [
        'array' => 'Le champ :attribute ne doit pas avoir plus de :max items.',
        'file' => 'Le champ :attribute ne doit pas être plus grand que :max kilobytes.',
        'numeric' => 'Le champ :attribute ne doit pas être supérieur à :max.',
        'string' => 'Le champ :attribute ne doit pas être supérieur à :max caractères.',
    ],
    'mimes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes' => 'Le champ :attribute doit être un fichier de type : :values.',
    'min' => [
        'array' => 'Le champ :attribute doit avoir au moins :min items.',
        'file' => 'Le champ :attribute doit être au moins de :min kilobytes.',
        'numeric' => 'Le champ :attribute doit être au moins de :min.',
        'string' => 'Le champ :attribute doit être au moins de :min caractères.',
    ],
    'not_in' => 'Le champ :attribute sélectionné n\'est pas valide.',
    'not_regex' => 'Le format du champ :attribute n\'est pas valide.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'password' => 'Le champ :attribute est incorrect.',
    'present' => 'Le champ :attribute doit être présent.',
    'regex' => 'Le format du champ :attribute n\'est pas valide.',
    'required' => 'Le champ :attribute est requis.',
    'required_if' => 'Le champ :attribute est requis lorsque :other est :value.',
    'required_unless' => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with' => 'Le champ :attribute est requis lorsque :values est présent.',
    'required_with_all' => 'Le champ :attribute est requis lorsque :values sont présents.',
    'required_without' => 'Le champ :attribute est requis lorsque :values n\'est pas présent.',
    'required_without_all' => 'Le champ :attribute est requis lorsque aucun de :values n\'est présent.',
    'same' => 'Le champ :attribute et :other doivent correspondre.',
    'size' => [
        'array' => 'Le champ :attribute doit contenir :size items.',
        'file' => 'Le champ :attribute doit être de :size kilobytes.',
        'numeric' => 'Le champ :attribute doit être de :size.',
        'string' => 'Le champ :attribute doit être de :size caractères.',
    ],
    'starts_with' => 'Le champ :attribute doit commencer par l\'une des valeurs suivantes : :values.',
    'string' => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone' => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique' => 'Le champ :attribute est déjà utilisé.',
    'uploaded' => 'Le champ :attribute n\'a pas pu être téléchargé.',
    'url' => 'Le format du champ :attribute n\'est pas valide.',
    'uuid' => 'Le champ :attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'phone_number' => [
            'regex' => 'Le format du champ :attribute n\'est pas valide pour la Mauritanie.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'phone_number' => 'Numéro de téléphone',
        // Ajoutez d'autres attributs selon vos besoins...
    ],

];
