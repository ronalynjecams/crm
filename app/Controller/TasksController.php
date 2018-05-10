<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$this->set('task', $this->Task->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
		}
		$departments = $this->Task->Department->find('list');
		$this->set(compact('departments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Task->delete()) {
			$this->Session->setFlash(__('The task has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The task could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	

	// CUSTOM
	public function task_list() {
		$status = $this->params['url']['status'];
		$user_id = $this->Auth->user('id');
		$userin = (array)$user_id;
		$dept_id = (array)$this->Auth->user('department_id');
		if($status=='Created') {
			$get_task = $this->Task->find('all',
				['conditions'=>['status'=>$status,
							   'created_by'=>$user_id]]);
		}
		else {
			$get_task_tmp = $this->Task->find('all',
				['conditions'=>['status'=>$status]]);
			$get_task  = [];
			foreach($get_task_tmp as $get_task_each) {
				$task_obj = $get_task_each['Task'];
				$created_by = $task_obj['created_by'];
				$ret_users = (array)json_decode($task_obj['users']);
				$ret_dept = (array)json_decode($task_obj['department_id']);
				if(in_array($userin, $ret_users) || in_array($dept_id, $ret_dept)
				   || $created_by==$user_id) {
				   	// pr($user_id."->".json_encode($ret_users)."=>".json_encode($ret_dept)."=>".$created_by);
					$get_task[] = $get_task_each;
				}
			}
		}

		$this->loadModel('User');
		$this->User->recursive = -1;
		$get_all_users = $this->User->find('all',
			['order'=>'first_name ASC',
			 'fields'=>'id, first_name, last_name']);
	
		$this->loadModel('Department');
		$this->Department->recursive = -1;
		$get_all_dept = $this->Department->find('all',
			['order'=>'Department.name ASC',
			 'fields'=>'id, name']);
			 
		$this->set(compact('status', 'get_task', 'get_all_users', 'get_all_dept'));
	}
	
	public function add_task() {
		$this->autoRender = false;
		$task_title = $this->request->data['task'];
		$userin = $this->Auth->user('id');
		$task_set = ['name'=>$task_title,
					 'status'=>'To-do',
					 'created_by'=>$userin];
		$this->Task->create();
		$this->Task->set($task_set);
		$this->Task->save();
		$inserted_task_id = $this->Task->getLastInsertId();
		return $inserted_task_id;
	}

	public function add() {
		$this->Task->recursive = -1;
		$get_all_tasks = $this->Task->find('all',
			['conditions'=>['NOT'=>['status'=>'Completed']],
			 'order'=>'created DESC']);
		$my_tasks = [];
		foreach($get_all_tasks as $ret_all_task) {
			$task_obj = $ret_all_task['Task'];
			$task_id = $task_obj['id'];
			$assigned_to = $task_obj['assigned_to'];
			$created_by = $task_obj['created_by'];
			$userin = $this->Auth->user('id');
			$dept_id = $this->Auth->user('department_id');
			if($assigned_to == 'users') {
				$users_obj = (array) json_decode($task_obj['users']);
				foreach($users_obj as $user_id) {
					if($user_id == $userin ||
					   $created_by == $userin) {
						$my_tasks[] = $ret_all_task;
					}
				}
			}
			elseif($assigned_to == 'department') {
				$department_id = $task_obj['department_id'];
				if($department_id == $dept_id ||
				   $created_by == $userin) {
					$my_tasks[] = $ret_all_task;
				}
			}
			else {
				if($created_by == $userin) {
					$my_tasks[] = $ret_all_task;
				}
			}
		}
		
		$this->loadModel('User');
		$this->User->recursive = -1;
		$get_all_users = $this->User->find('all',
			['order'=>'first_name ASC',
			 'fields'=>'id, first_name, last_name']);
	
		$this->loadModel('Department');
		$this->Department->recursive = -1;
		$get_all_dept = $this->Department->find('all',
			['order'=>'Department.name ASC',
			 'fields'=>'id, name']);
		$this->set(compact('my_tasks', 'get_all_users', 'get_all_dept'));
	}

	public function get_task() {
		$this->autoRender = false;
		$task_id = $this->request->query['id'];
		$this->Task->recursive = -1;
		$get_task = $this->Task->findById($task_id);
		return json_encode($get_task);
	}
	
	public function delete_task() {
		$this->autoRender = false;
		$task_id = $this->request->data['id'];
		
		$this->loadModel('TaskDetail');
		$this->TaskDetail->recursive = -1;
		$get_subtask = $this->TaskDetail->find('all',
			['conditions'=>['task_id'=>$task_id],
			 'fields'=>'TaskDetail.id']);
			 
		$subtask_ids = [];
		foreach($get_subtask as $ret_subtask) {
			$subtask_obj = $ret_subtask['TaskDetail'];
			$subtask_ids[] = $subtask_obj['id'];
		}
		
		$DS_Task = $this->Task->getDataSource();
		if(!empty($subtask_ids)) {
			$DS_Subtask = $this->Subtask->getDataSource();
			$DS_Subtask->begin();
			$delete_set = ['TaskDetail.id'=>$subtask_ids];
			if ($this->TaskDetail->deleteAll($delete_set, false)) {
				echo "TaskDetail deleted";
				$DS_Task->begin();
				$this->Task->id = $task_id;
				if($this->Task->delete()) {
					echo "Task deleted";
					$DS_Subtask->commit();
					$DS_Task->commit();
				}
				else {
					$DS_Subtask->rollback();
					$DS_Task->rollback();
					return "Error in task!";
				}
			}
			else {
				return "Error in TaskDetail!";
			}
		}
		else {
			$DS_Task->begin();
			$this->Task->id = $task_id;
			if($this->Task->delete()) {
				echo "Task deleted";
				$DS_Task->commit();
			}
			else {
				$DS_Task->rollback();
				return "Error in task!";
			}
		}
	}
	
	public function done_task() {
		$this->autoRender = false;
		$id = $this->request->data['id'];
		$this->Task->id = $id;
		$this->Task->set(['status'=>'Completed']);
		$this->Task->save();
		return "Task saved";
	}
	
	public function add_subtask() {
		$this->autoRender = false;
		$subtasks = $this->request->data;
		$id = $subtasks["id"];
		$orig_title = $subtasks["orig_title"];
		$title = $subtasks["title"];
		$cb = $subtasks["cb"];
		$select = $subtasks["select"];
		$deadline = $subtasks["deadline"];
		$notes = $subtasks["notes"];
		$subtasks_details = $subtasks["subtasks"];
		$userid = $this->Auth->user('id');
		$dept = '';
		$users = '';
		if($cb=="depts") {
			$dept = json_encode($select);
		}
		else {
			$users = json_encode($select);
		}
		
		if($orig_title!=$title) {
			$task_name = $title;
			$task_set = ["name"=>$task_name,
						 "assigned_to"=>$cb,
						 "users"=>$users,
						 "dept"=>$dept,
						 "deadline"=>$deadline,
						 "created_by"=>$userid];
		}
		else {
			$task_set = ["assigned_to"=>$cb,
						 "users"=>$users,
						 "dept"=>$dept,
						 "deadline"=>$deadline,
						 "created_by"=>$userid];
		}
		
		$subtasks_set = ["task_id"=>$id,
						 "subtask"=>$subtasks_details,
						 "notes"=>$notes];
						 
		$this->loadModel('Subtask');
		$this->Subtask->recursive = -1;
		$find_subtask = $this->Subtask->find('all',
			['conditions'=>['task_id'=>$id],
			 'fields'=>'Subtask.id']);
		$subtask_ids = [];
		foreach($find_subtask as $found_subtask) {
			$subtask_obj = $found_subtask['Subtask'];
			$subtask_ids[] = $subtask_obj['id'];
		}
		
		$DS_Subtask = $this->Subtask->getDataSource();
		$DS_Task = $this->Task->getDataSource();
		$DS_Subtask->begin();
		
		if(!empty($subtask_ids)) {
			$delete_set = ['Subtask.id'=>$subtask_ids];
			if ($this->Subtask->deleteAll($delete_set, false)) {
				$this->Subtask->create();
				$this->Subtask->set($subtasks_set);
				if($this->Subtask->save()) {
					$DS_Task->begin();
					$this->Task->id = $id;
					$this->Task->set($task_set);
					if($this->Task->save()) {
						$DS_Subtask->commit();
						$DS_Task->commit();
					}
					else {
						$DS_Subtask->rollback();
						$DS_Task->rollback();
					}
				}
				else {
					$DS_Subtask->rollback();
				}
			}
			else {
				$DS_Subtask->rollback();
			}
		}
		else {
			$this->Subtask->create();
			$this->Subtask->set($subtasks_set);
			if($this->Subtask->save()) {
				$DS_Task->begin();
				$this->Task->id = $id;
				$this->Task->set($task_set);
				if($this->Task->save()) {
					$DS_Subtask->commit();
					$DS_Task->commit();
				}
				else {
					$DS_Subtask->rollback();
					$DS_Task->rollback();
				}
			}
			else {
				$DS_Subtask->rollback();
			}
		}
		return json_encode($subtasks);
	}
	
	public function get_subtask() {
		$this->autoRender = false;
		
	}

	public function begin_task() {
		$this->autoRender = false;
		$id = $this->request->data['id'];
		$this->Task->id = $id;
		$this->Task->set(['status'=>'Ongoing']);
		if($this->Task->save()) {
			return "~Task saved";
		}
		else {
			return "~ERROR in task";
		}
	}
	
	public function del_subtask() {
		$this->autoRender = false;
		$id = $this->request->data;
		
		$this->loadModel('SubTask');
		$this->Subtask->id = $id;
		if($this->Subtask->delete()) {
			return "Subtask deleted";
		}
		else {
			return "Error in Subtask";
		}
	}
}
