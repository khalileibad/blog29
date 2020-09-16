<?php
	/**
	* news Controller, 
	* This Called after admin
	*/
	class news extends controller
	{
		/**
		* The Default Method
		* No return (void)
		*/
		function __construct()
		{
			parent::__construct();
			$this->view->CSS = array();
			$this->view->JS = array('views/news/JS/news.js');
		}
		
		//Display user window
		function index()
		{
			array_push($this->view->JS,"public/JS/img.js");
			$this->view->render(array('news/index'));
		}
		
		/**
		* news_list
		* AJAX fun
		* get news_ list
		*/
		function news_list()
		{
			$this->view->news_list	= $this->model->news_list();
			if(is_array($this->view->news_list))
			{
				$this->view->js_render('news/AJAX/news');
			}else
			{// if There Is Error!
				echo $this->view->news_list;
			}
		}
		
		/**
		* news_data
		* AJAX fun
		* get news date
		*/
		function news_data($id=0)
		{
			echo json_encode($this->model->news_data($id));
		}
		
		/**
		* new_news
		* create New news
		* AJAX
		*/
		function new_news()
		{
			echo json_encode($this->model->new_news());
		}
		
		/**
		* upd_news
		* update news
		* AJAX
		*/
		function upd_news()
		{
			echo json_encode($this->model->upd_news());
		}
		
		/**
		* del_news
		* delete news
		* AJAX
		*/
		function del_news()
		{
			echo json_encode($this->model->del_news());
		}
		
		/**
		* active
		* active/Freez news
		* AJAX
		*/
		function active()
		{
			echo json_encode($this->model->active());
		}
		
	}
?>