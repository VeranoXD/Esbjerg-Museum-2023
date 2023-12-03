<?php

namespace MABEL_BHI_LITE\Core
{

	class Loader
	{
		protected $fired_actions;
		protected $fired_filters;

		protected $actions;
		protected $filters;

		public function __construct()
		{
			$this->reset();
			$this->fired_action = array();
			$this->fired_filters = array();
		}

		public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 )
		{
			$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
		}


		public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 )
		{
			$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
		}

		private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args )
		{
			$hooks[] = array(
				'hook'          => $hook,
				'component'     => $component,
				'callback'      => $callback,
				'priority'      => $priority,
				'accepted_args' => $accepted_args
			);
			return $hooks;
		}

		public function run()
		{

			foreach ( $this->filters as $hook ) {
				if(! method_exists($hook['component'],$hook['callback'])){
					throw new \Exception("Can't add filter. Method ". $hook['callback'] . " doesn't exist.");
				}
				add_filter( $hook['hook'], ($hook['component'] === null? $hook['callback'] : array( $hook['component'], $hook['callback'] )), $hook['priority'], $hook['accepted_args'] );
				array_push($this->fired_filters, $hook['hook']);
			}

			foreach ( $this->actions as $hook ) {
				if(! method_exists($hook['component'],$hook['callback'])){
					throw new \Exception("Can't add action. Method ". $hook['callback'] . "doesn't exist.");
				}
				add_action( $hook['hook'], ($hook['component'] === null? $hook['callback'] : array( $hook['component'], $hook['callback'] )), $hook['priority'], $hook['accepted_args'] );
				array_push($this->fired_action, $hook['hook']);
			}

			$this->reset();

		}

		private function reset()
		{

			$this->filters = array();
			$this->actions = array();

		}

	}

}