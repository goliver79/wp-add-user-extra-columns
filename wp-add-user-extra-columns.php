<?php
	if ( ! defined( 'WPINC' ) ) {
		die;
	}

	if ( !class_exists( 'GoAddUsersExtraColumns' ) ) {
		class GoAddUsersExtraColumns{
			function activate(){
				add_filter( 'manage_users_columns', array( $this, 'go_add_user_extra_columns' ) );
				add_action( 'manage_users_custom_column',  array( $this, 'go_show_user_extra_columns_info' ), 10, 3 );
			}
			function go_add_user_extra_columns($columns) {
				$columns['go_school'] = __( 'School', goaddusersextracolumns );
				$columns['go_school_number'] = __( 'School Number', goaddusersextracolumns );
				return $columns;
			}
			function go_show_user_extra_columns_info($value, $column_name, $user_id) {
				switch ($column_name) {
					case 'logopeda_school' :
						return get_user_meta( $user_id, 'go_school', true );
						break;

					case 'logopeda_number' :
						return get_user_meta( $user_id, 'go_school_number', true);
						break;

					default:
						return $value;
				}
			}
		}
		$go_add_users_extra_columns = new GoAddUsersExtraColumns();
		$go_add_users_extra_columns->activate();
	}