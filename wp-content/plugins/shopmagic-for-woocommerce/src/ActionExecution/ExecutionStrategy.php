<?php

namespace WPDesk\ShopMagic\ActionExecution;

use WPDesk\ShopMagic\Action\Action;
use WPDesk\ShopMagic\Automation\Automation;
use WPDesk\ShopMagic\Event\Event;
use WPDesk\ShopMagic\Exception\ActionDisabledAfterStatusRecheckException;

/**
 * Specifics how to execute an action.
 *
 * @package WPDesk\ShopMagic\ActionExecution
 *
 * @TODO: in 3.0 split into abstraction and stable packages
 */
interface ExecutionStrategy {
	/**
	 * Execution is hitting ->execute method in action so in theory it is simple.
	 * But execution can be deferred using various tools or depends on additional variables.
	 *
	 * @param Automation $automation
	 * @param Event $event
	 * @param Action $action
	 * @param int $action_index Index action in automation. Required to properly connect the action with automation.
	 * @param string $unique_id Unique id of the execution. Is required to track what is going on with a single execution.
	 *
	 * @return string Unique execution id.
	 *
	 * @throws ActionDisabledAfterStatusRecheckException If event supports SupportsDeferredCheck this exception can be thrown.
	 */
	public function execute( Automation $automation, Event $event, Action $action, $action_index, $unique_id );
}
