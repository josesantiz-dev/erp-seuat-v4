<?php
	class Dashboard extends Controllers{
		public function __construct()
		{
            session_start();

			parent::__construct();
		}

		public function Dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard DIRC";
			$data['page_title'] = "Página Dashboard";
			$data['page_name'] = "Página Dashboard";
			$this->views->getView($this,"dashboard",$data);
		}
	}
?>