<?php
function bizwhoop_homepage_setting( $wp_customize ) { 

	/* Option list of all post */  
    $options_pages = array();
    $options_pages_obj = get_pages('posts_per_page=-1');
    $options_pages[''] = __( 'Choose Page', 'bizwhoop' );
    foreach ( $options_pages_obj as $posts ) {
    	$options_pages[$posts->ID] = $posts->post_title;
    } 

	$service_pages = array();
    $service_pages_obj = get_pages('posts_per_page=-1');
    $service_pages[''] = __( 'Choose Page', 'bizwhoop' );
    foreach ( $service_pages_obj as $posts ) {
    	$service_pages[$posts->ID] = $posts->post_title;
    } 
	
	
	

			$wp_customize->add_panel( 'homepage_setting', array(
                'priority'       => 400,
                'capability'     => 'edit_theme_options',
                'title'      => __('Homepage Settings', 'bizwhoop'),
            ) );

            /* --------------------------------------
            =========================================
            Slider Section
            =========================================
            -----------------------------------------*/ 
            $wp_customize->add_section(
                'bizwhoop_slider_section_settings', array(
                'title' => __('Slider Setting','bizwhoop'),
                'description' => '',
                'panel'  => 'homepage_setting',
            ) );
            
            
            //Enable slider
            $wp_customize->add_setting(
                'bizwhoop_slider_enable', 
				array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_checkbox',
            ) );    
            $wp_customize->add_control( 
                'bizwhoop_slider_enable', array(
                'label'   => __('Enable Slider Section','bizwhoop'),
                'section' => 'bizwhoop_slider_section_settings',
                'type' => 'checkbox',
            ) );
            
            //Select Post One
            $wp_customize->add_setting('slider_post_one',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('slider_post_one',array(
                'label' => __('Select Page One','bizwhoop'),
                'section'=>'bizwhoop_slider_section_settings',
                'type'=>'select',
                'choices'=>$options_pages,
            ));
            
            //Select Post Two
            $wp_customize->add_setting('slider_post_two',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('slider_post_two',array(
                'label' => __('Select Page Two','bizwhoop'),
                'section'=>'bizwhoop_slider_section_settings',
                'type'=>'select',
                'choices'=>$options_pages,
            ));
            
            //Select Post Three
            $wp_customize->add_setting('slider_post_three',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('slider_post_three',array(
                'label' => __('Select Page Three','bizwhoop'),
                'section'=>'bizwhoop_slider_section_settings',
                'type'=>'select',
                'choices'=>$options_pages,
            ));

		    /* --------------------------------------
		    =========================================
		    Serice Section
		    =========================================
		    -----------------------------------------*/  
		    // add section to manage Services
		    $wp_customize->add_section(
		        'bizwhoop_service_section_settings', array(
		        'title' => __('Service Setting','bizwhoop'),
		        'panel'  => 'homepage_setting',
		    ) );

            //Enable service
            $wp_customize->add_setting(
                'bizwhoop_service_enable', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_checkbox',
            ) );    
            $wp_customize->add_control( 
                'bizwhoop_service_enable', array(
                'label'   => __('Enable Service Section','bizwhoop'),
                'section' => 'bizwhoop_service_section_settings',
                'type' => 'checkbox',
            ) );

            //Service Title setting
		   	$wp_customize->add_setting(
                'bizwhoop_service_title', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
            ) );	
            $wp_customize->add_control( 
            	'bizwhoop_service_title',array(
                'label'   => __('Service Title','bizwhoop'),
                'section' => 'bizwhoop_service_section_settings',
                'type' => 'text',
            ) );

            //Service SubTitle setting
            $wp_customize->add_setting(
                'bizwhoop_service_subtitle', array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
            ) );  
            $wp_customize->add_control( 'bizwhoop_service_subtitle', array(
                'label'   => __('Service Subtitle','bizwhoop'),
                'section' => 'bizwhoop_service_section_settings',
                'type' => 'textarea',
            ) );
			
			
			 //Select Service One
            $wp_customize->add_setting('service_post_one',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('service_post_one',array(
                'label' => __('Select Service One','bizwhoop'),
                'section'=>'bizwhoop_service_section_settings',
                'type'=>'select',
                'choices'=>$service_pages,
            ));
            
            //Select Post Two
            $wp_customize->add_setting('service_post_two',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('service_post_two',array(
                'label' => __('Select Service Two','bizwhoop'),
                'section'=>'bizwhoop_service_section_settings',
                'type'=>'select',
                'choices'=>$service_pages,
            ));
            
            //Select Post Three
            $wp_customize->add_setting('service_post_three',array(
                'capability'=>'edit_theme_options',
                'sanitize_callback'=>'sanitize_text_field',
            ));
            
            $wp_customize->add_control('service_post_three',array(
                'label' => __('Select Service Three','bizwhoop'),
                'section'=>'bizwhoop_service_section_settings',
                'type'=>'select',
                'choices'=>$service_pages,
            ));
			
			/* --------------------------------------
		    =========================================
		    Callout Section
		    =========================================
		    -----------------------------------------*/
		    // add section to manage Callout
		    $wp_customize->add_section(
		    	'bizwhoop_callout_section_settings', array(
		        'title' => __('Callout Setting','bizwhoop'),
		        'panel'  => 'homepage_setting',
		    ) );
			
			//Enable callout
            $wp_customize->add_setting(
                'bizwhoop_callout_enable', 
				array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_checkbox',
            ) );    
            $wp_customize->add_control( 
                'bizwhoop_callout_enable', array(
                'label'   => __('Enable Callout Section','bizwhoop'),
                'section' => 'bizwhoop_callout_section_settings',
                'type' => 'checkbox',
            ) );
			
			
			
			


		    //Callout Background image
		    $wp_customize->add_setting( 
		    	'bizwhoop_callout_background', array(
		    	'sanitize_callback' => 'esc_url_raw',
		    ) );

		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
		    	'bizwhoop_callout_background', array(
		    	'label'    => __( 'Choose Background Image', 'bizwhoop' ),
		    	'section'  => 'bizwhoop_callout_section_settings',
		    	'settings' => 'bizwhoop_callout_background',) 
		    ) );

		   //Callout Text Color setting
            $wp_customize->add_setting(
                'bizwhoop_callout_text_color', array( 'sanitize_callback' => 'sanitize_text_field',
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'bizwhoop_callout_text_color', array(
               'label'      => __('Text Color', 'bizwhoop' ),
                'palette' => true,
                'section' => 'bizwhoop_callout_section_settings')
            ) );
			

            //Callout align Setting
            $wp_customize->add_setting(
                'bizwhoop_callout_text_align', array(
                'default' => 'left',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
            ) );  
            $wp_customize->add_control( 
                'bizwhoop_callout_text_align',array(
                'label' => __('Callout Text Align','bizwhoop'),
                'section' => 'bizwhoop_callout_section_settings',
                'type' => 'radio',
                'choices'=>array('left'=>'text-left','center'=>'text-center','right'=>'text-right'),
            ) );

		    // Callout Title Setting
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_title', array(
		        'default' => __('ready to work with <span>you</span>','bizwhoop'),
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_title', array(
		    	'label'   => __('Callout Title','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'text',
		    ) );	

			// Callout Description Setting	    
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_description', array(
		        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dolor tellus, egestas id elit in, vestibulum imperdiet ligula. Sed cursus velit sem, ut ultrices risus tincidunt a. Nullam id neque ipsum. Duis posuere fermentum purus, eget vehicula est accumsan maximus',
		        'capability'     => 'edit_theme_options',
		        'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_description', array(
		    	'label'   => __('Callout Description','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'textarea',
		    ) );	

		    // Callout Button One Label Setting	 
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_one_label', array(
		        'default' => __('Buy Now!','bizwhoop'),
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_one_label', array(
		    	'label' => __('Button One Title','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Link Setting	
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_one_link', array(
		        'default' => __('#','bizwhoop'),
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_one_link',array(
		    	'label' => __('Button One URL','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button One Target Setting	
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_one_target', array(
		        'default' => 'true',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_one_target',array(
		    	'label' => __('Open Link New window','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );

		    //Callout Button Two Label Setting	
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_two_label', array(
		        'default' => __('Know More','bizwhoop'),
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_two_label', array(
		    	'label' => __('Button Two Title','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'text',
		    ) );	

		    //Callout Button Two Link Setting
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_two_link', array(
		        'default' => '#',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'esc_url_raw',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_two_link', array(
		    	'label' => __('Button Two URL','bizwhoop'),
		    	'type' => 'text',
		    	'section' => 'bizwhoop_callout_section_settings',
		    ) );	

		    //Callout Button Two Target Setting
		    $wp_customize->add_setting(
		    	'bizwhoop_callout_button_two_target', array(
		        'default' => 'true',
		        'capability' => 'edit_theme_options',
		        'sanitize_callback' => 'sanitize_text_field',
		    ) );	
		    $wp_customize->add_control( 
		    	'bizwhoop_callout_button_two_target', array(
		    	'label' => __('Open Link New window','bizwhoop'),
		    	'section' => 'bizwhoop_callout_section_settings',
		    	'type' => 'checkbox',
		    ) );
			
	
			/* --------------------------------------
            =========================================
            Latest News Section
            =========================================
            -----------------------------------------*/
            // add section to manage Latest News
            $wp_customize->add_section(
                'bizwhoop_news_section_settings', array(
                'title' => __('News & Events Setting','bizwhoop'),
                'description' => '',
                'panel'  => 'homepage_setting'
            ) );
            
            //Latest News Enable / Disable setting
            $wp_customize->add_setting(
                'bizwhoop_news_enable', 
				array(
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_checkbox',
            ) );    
            $wp_customize->add_control( 
                'bizwhoop_news_enable', array(
                'label'   => __('Enable News Section','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'checkbox',
            ) );
			
			
			
			
			
			
			

            //Latest News Background Image
            $wp_customize->add_setting( 
                'bizwhoop_news_background', array(
                'sanitize_callback' => 'esc_url_raw',
            ) );
            $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
                'bizwhoop_news_background', array(
                'label'    => __( 'Choose Background Image', 'bizwhoop' ),
                'section'  => 'bizwhoop_news_section_settings',
                'settings' => 'bizwhoop_news_background', ) 
            ) );
            
            //Latest News Overlay color
            $wp_customize->add_setting(
                'bizwhoop_news_overlay_color', array( 'sanitize_callback' => 'sanitize_text_field',
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'bizwhoop_news_overlay_color', array(
                'label' => __('Overlay Color', 'bizwhoop' ),
                'palette' => true,
                'section' => 'bizwhoop_news_section_settings')
            ) );

            //Latest News text color
            $wp_customize->add_setting(
                'bizwhoop_news_text_color', array( 'sanitize_callback' => 'sanitize_text_field',
            ) );
            
            $wp_customize->add_control(new WP_Customize_Color_Control( $wp_customize,'bizwhoop_news_text_color', array(
                'label' => __('Text Color', 'bizwhoop' ),
                'palette' => true,
                'section' => 'bizwhoop_news_section_settings')
            ) );

            // hide meta content
            $wp_customize->add_setting(
                'disable_news_meta', array(
                'default' => 'false',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control(
                'disable_news_meta', array(
                'label' => __('Hide/Show Blog Meta:- Like author name,categories','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'checkbox',
            ) );

            // Latest News Title Setting
            $wp_customize->add_setting(
                'bizwhoop_news_title', array(
                'default' => 'Latest News',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );    
            $wp_customize->add_control( 
                'bizwhoop_news_title',array(
                'label'   => __('Latest News Title','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'text',
            ) );

            // Latest News Subtitle Setting
            $wp_customize->add_setting(
                'bizwhoop_news_subtitle', array(
                'default' => 'laoreet ipsum eu laoreet. ugiignissimat Vivamus dignissim feugiat erat sit amet convallis.',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'bizwhoop_homepage_sanitize_text',
            ) );  
            $wp_customize->add_control( 
                'bizwhoop_news_subtitle',array(
                'label'   => __('Latest News Subtitle','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'textarea',
            ) );    

            //Select number of latest news on front page
            $wp_customize->add_setting(
                'news_select', array(
                'default' =>'3',
                'sanitize_callback' => 'sanitize_text_field',
            ) );

            $wp_customize->add_control(
                'news_select', array(
                'type' => 'select',
                'label' => __('Select Number of Post','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'choices' => array('3'=>__('3', 'bizwhoop'),'6' => __('6','bizwhoop'), '9' => __('9','bizwhoop'),'12'=> __('12','bizwhoop'), '15'=> __('15','bizwhoop'),'18'=> __('18','bizwhoop'), '21' =>__('21','bizwhoop')),
            ) );

            // Latest News View Button Label Setting
            $wp_customize->add_setting(
                'view_button_label', array(
                'default' => __('View More','bizwhoop'),
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );    
            $wp_customize->add_control( 
                'view_button_label', array(
                'label'   => __('Button label','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'text',
            ) );

            // Latest News View Button Link Setting
            $wp_customize->add_setting(
                'view_button_link', array(
                'default' => '#',
                'capability'     => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );    
            $wp_customize->add_control( 
                'view_button_link',array(
                'label'   => __('Button Link','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'text',
            ) ); 

            // Latest News View Button Traget Setting
            $wp_customize->add_setting(
                'view_button_link_target', array(
                'default' => 'true',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ) );    
            $wp_customize->add_control( 
                'view_button_link_target', array(
                'label' => __('Open link New window or Tab','bizwhoop'),
                'section' => 'bizwhoop_news_section_settings',
                'type' => 'checkbox',
            ) );

            
	function bizwhoop_homepage_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

	}
	
	
	function bizwhoop_homepage_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
	}
}
add_action( 'customize_register', 'bizwhoop_homepage_setting' );
?>