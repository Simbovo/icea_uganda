<?php

Array
(
    [1] => Array
        (
            [0] => Array
                (
                    [id] => 1
                    [name] => Administration
                    [link] => #
                    [icon] => fa fa-ban
                )

            [children] => Array
                    [0] => Array
                        (
                            [id] => 2
                            [name] => Module Setup
                            [link] => /default/modules
                            [ico
                (n] => 
                        )

                    [1] => Array
                        (
                            [id] => 3
                            [name] => Agency
                            [link] => /default/agency
                            [icon] => 
                        )

                    [2] => Array
                        (
                            [id] => 4
                            [name] => System Params
                            [link] => /default/system-params
                            [icon] => 
                        )

                    [3] => Array
                        (
                            [id] => 5
                            [name] => Roles
                            [link] => /default/roles
                            [icon] => 
                        )

                    [4] => Array
                        (
                            [id] => 6
                            [name] => Occupations
                            [link] => /default/occupations
                            [icon] => 
                        )

                )

        )

    [5] => Array
        (
            [0] => Array
                (
                    [id] => 5
                    [name] => User Setup
                    [link] => #
                    [icon] => #
                )

            [children] => Array
                (
                    [0] => Array
                        (
                            [id] => 8
                            [name] => Confirmations
                            [link] => /default/modules
                            [icon] => 
                        )

                    [1] => Array
                        (
                            [id] => 9
                            [name] => Add as User
                            [link] => /default/agency
                            [icon] => 
                        )

                    [2] => Array
                        (
                            [id] => 10
                            [name] => Online Staff
                            [link] => /default/system-params
                            [icon] => 
                        )

                    [3] => Array
                        (
                            [id] => 11
                            [name] => Register Staff
                            [link] => /default/roles
                            [icon] => 
                        )

                    [4] => Array
                        (
                            [id] => 12
                            [name] => System Users
                            [link] => /default/occupations
                            [icon] => 
                        )

                    [5] => Array
                        (
                            [id] => 13
                            [name] => User Management
                            [link] => /default/occupations
                            [icon] => 
                        )

                )

        )

    [2] => Array
        (
            [0] => Array
                (
                    [id] => 2
                    [name] => Confirmation
                    [link] => #
                    [icon] => fa fa-check
                )

        )

    [6] => Array
        (
            [0] => Array
                (
                    [id] => 6
                    [name] => Agents
                    [link] => #
                    [icon] => #
                )

        )

    [3] => Array
        (
            [0] => Array
                (
                    [id] => 3
                    [name] => Transactions
                    [link] => #
                    [icon] => fa fa-database
                )

        )

    [7] => Array
        (
            [0] => Array
                (
                    [id] => 7
                    [name] => Members
                    [link] => #
                    [icon] => fa fa-check
                )

        )

)


foreach ($rows as $row) {
                $thisref = $refs[$row['mod_module_group_code']];
                $thisref['menu_parent_id'] = is_null($row['mod_child_id']) ? 0 : $row['mod_module_group_code'];
                $thisref['link'] = is_null($row['mod_module_name']) ? $row['mod_url'] : $row['mod_module_uri'];
                $thisref['name'] = is_null($row['mod_module_name']) ? $row['mod_module_group_name'] : $row['mod_module_name'];
                $thisref['icon'] = $row['mod_module_icon'];
                if ($row['parent_id'] == 0) {
                    $list[$row['mod_module_group_code']] = $thisref;
                } else {
                    $refs[$row['parent_id']]['children'][$row['mod_module_group_code']] = $thisref;
                }
            }