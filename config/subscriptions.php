<?php

return [
    /*
    | Pupil parameters
    |
    */
    'section' => [
        'fr' => 'French section',
        'en' => 'English section',
    ],

    'education' => [
        'gn' => 'General education',
        'th' => 'Technical education'
    ],

    'cycle' => [
        1 => 'First cycle',
        2 => 'Second cycle',
    ],

    'series' => [
        'fr' => [
            'gn' => ['A', 'B', 'C', 'D', 'E', 'TI'],
            'th' => ['ACA', 'CG', 'ACC', 'FIG', 'AF', 'CI', 'F1', 'F2', 'F3', 'F4', 'F5', 'F7', 'F8', 'AG', 'EF', 'ESF', 'GT', 'HH', 'HR', 'IB', 'IS', 'MA', 'MAV', 'MEB', 'MEM', 'MF/CM', 'MHB', 'TAC', 'TGT', 'AG', 'SEBU', 'ESCOM'],
        ],
        'en' => [
            'gn' => ['Literature', 'Science', 'Arts'],
            'th' => ['ACA', 'CG', 'ACC', 'FIG', 'AF', 'CI', 'F1', 'F2', 'F3', 'F4', 'F5', 'F7', 'F8', 'AG', 'EF', 'ESF', 'GT', 'HH', 'HR', 'IB', 'IS', 'MA', 'MAV', 'MEB', 'MEM', 'MF/CM', 'MHB', 'TAC', 'TGT', 'AG', 'SEBU', 'ESCOM'],
        ],
    ],

    'class' => [
        'fr' => [
            1 => ['4è', '3è'],
            2 => ['2nd', '1ère', 'Tle']
        ],
        'en' => [
            1 => ['Form 3', 'Form 4', 'Form 5'],
            2 => ['Lower sixth', 'Upper sixth'],
        ]
    ],

    'language' => [
        'en' => 'English',
        'fr' => 'French',
        'bi' => 'Bilingual'
    ],

    /*
    | Student
    |
    */
    'university' => [
        'bda' => 'Bamenda', 
        'buea' => 'Buea',
        'dla' => 'Douala',
        'dsh' => 'Dschang',
        'mra' => 'Maroua',
        'ngd' => 'Ngaoundéré',
        'yde-1' => 'Yaoundé I',
        'yde-2' => 'Yaoundé II',
    ],

    'training_school' => [
        'bda' => [
            'Faculty of Arts',
            'Faculty of Law and Political Science',
            'Faculty of Economics and Management Science',
            'Faculty of Education',
            'Faculty of Science',
            'Faculty of Health science',
            'The College of Technology',
            'The Higher Institute of Commerce and Management',
            'The Higher Institute of Transport and logistics',
            'The Higher Teachers’ Training College of Bamenda in Bambili',
            'The Higher Technical Teachers’ Training College of Bamenda in Bambili',
            'National Higher Polytechnic Institute',
        ],
        'buea' => [
            'Faculty of Health Sciences',
            'Faculty of Engineering and Technology',
            'Faculty of Arts',
            'Faculty of Education',
            'Faculty of Science',
            'Faculty of Social and Management Sciences',
            'Faculty of Agriculture and Veterinary Medicine',
            'Faculty of Laws and Political Science',
            'Advanced School of Translators and Interpreters',
            'College of Technology',
            'Higher Technical Teachers Training College (ENSET Kumba)',
        ],
        'dla' => [
            'Ecole Normale Supérieure d’Enseignement Technique (ENSET)',
            'Ecole Supérieure des Sciences Economiques et Commerciales de l’Université de
            Douala (ESSEC)',
            'Institut Universitaire de Technologie (IUT)',
            'Institut des Sciences Halieutiques (ISH)',
            'École nationale supérieure polytechnique de Douala (ENSPD)',
            'Institut des Beaux-Arts (IBA)',
            'Faculté des Sciences',
            'Faculté des Sciences Juridiques et Politiques',
            'Faculté des Lettres et Sciences Humaines',
            'Faculté des Sciences Économiques et Gestion Appliquée',
            'Faculté de Médecine et Sciences Pharmaceutiques'
        ],
        'dsh' => [
            'Centre Régional d’Enseignement Spécialisé en Agriculture (CRESA)',
            'Institut des Beaux-Arts de Foumban (IBAF)',
            'Faculté d’Agronomie et des Sciences Agricoles (FASA)',
            'Faculté de Médecine et de Sciences Pharmaceutiques',
            'Institut Universitaire Fotso Victor (IUT-FV) de Bandjoun',
            'Faculté des sciences juridiques et politiques',
            'Faculté des sciences économiques et de gestion',
            'Faculté des sciences',
            'Faculté des lettres et sciences humaines',
        ],
        'mra' => [
            'Ecole Normale Supérieure (ENS)',
            'Ecole Nationale supérieure Polytechnique',
            'École nationale supérieure des Mines et des Industries pétrolières (ENSMP)',
            'Faculté des sciences économiques et de gestion (FSEG)',
            'Faculté des sciences (FS)',
            'Faculté des sciences juridiques et politiques (FSJP)',
            'Faculté des arts et lettres et sciences humaines (FALSH)',
        ],
        'ngd' => [
            'Ecole des Sciences et de Médecine Vétérinaire (ESMV)',
            'Institut Universitaire de Technologie (IUT)',
            'Ecole Nationale Supérieure des Sciences Agro-Industrielles (ENSAI)',
            'Ecole de Géologie et d’Exploitation Minière',
            'Faculté de Médecine et de Sciences Biomédicales',
            'Ecole de Génie Chimique et des Industries Minérales',
            'Ecole Normale supérieure Bertoua',
            'Faculté des sciences',
            'Faculté des arts',
            'Faculté de lettres et des sciences humaines',
            'Faculté des sciences juridiques et politiques',
            'Faculté des sciences économiques et de gestion',
        ],
        'yde-1' => [
            'Ecole Normale Supérieure (ENS) de l\'Université',
            'Classes Scientifiques Spéciales de l’Ecole Normale Supérieure (ENS)',
            'Ecole Nationale Supérieure Polytechnique (ENSP)',
            'Cycle de Licence Professionnelle en Tourisme de la Faculté des Arts, Lettres et
            Sciences Humaines',
            'Institut Universitaire de Technologie (IUT) de Bois de Mbalmayo',
            'ENSET Ebolowa',
            'Faculté des arts, lettres et sciences humaines (FALSH)',
            'Faculté des sciences (FS)',
            'Faculté de médecine et de sciences biomédicales (FMSB)',
            ' Faculté des sciences de l’éducation',
        ],
        'yde-2' => [
            'Ecole Supérieure des Sciences et Techniques de l’Information et de la
            Communication (ESSTIC)',
            'Institut des Relations Internationales du Cameroun (IRIC)',
            'Institut de Formation et de Recherche Démographique (IFORD)',
            'Faculté des sciences juridiques et politiques (FSJP)',
            'Faculté des sciences économiques et de gestion (FSEG)',
            'Institut National de la Jeunesse et des Sports (INJS)',
            'Ecole Nationale Supérieure des Travaux Publics (ENSTP)',
            'Ecole Nationale Supérieure des Postes et Télécommunications (ENSPT)',
            'Institut Africain d\'Informatique',
            'Institut Sous-Régional de statistique et d\'Economie appliquée (ISSEA)',
            'Ecole Nationale Supérieure de Police (ENSP)',
            'Ecole Militaire Interarmes (EMIA)',
            'Ecole Nationale d’Administration et de Magistrature (ENAM)'
        ]
    ]
];