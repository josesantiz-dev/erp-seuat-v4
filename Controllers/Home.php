<?php

	class Home extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function home()
		{
			$data['page_id'] = 1;
			$data['page_tag'] = "Home";
			$data['page_title'] = "Página principal";
			$data['page_name'] = "home";
			$data['page_content'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum molestie metus vitae porta dapibus. Nulla vehicula erat viverra elit bibendum, in hendrerit eros faucibus. Nunc metus libero, ornare et ultricies eget, bibendum vitae risus. Nullam facilisis ipsum eu ipsum interdum, id porttitor augue tempus.";
			$this->views->getView($this,"home",$data);
		}
	}
?>