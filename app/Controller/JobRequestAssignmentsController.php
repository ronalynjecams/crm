<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestAssignments Controller
 *
 * @property JobRequestAssignment $JobRequestAssignment
 * @property PaginatorComponent $Paginator
 */
class JobRequestAssignmentsController extends AppController {

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
		$this->JobRequestAssignment->recursive = 0;
		$this->set('jobRequestAssignments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestAssignment->exists($id)) {
			throw new NotFoundException(__('Invalid job request assignment'));
		}
		$options = array('conditions' => array('JobRequestAssignment.' . $this->JobRequestAssignment->primaryKey => $id));
		$this->set('jobRequestAssignment', $this->JobRequestAssignment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequestAssignment->create();
			if ($this->JobRequestAssignment->save($this->request->data)) {
				$this->Session->setFlash(__('The job request assignment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request assignment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jobRequestProducts = $this->JobRequestAssignment->JobRequestProduct->find('list');
		$jobRequestFloorplans = $this->JobRequestAssignment->JobRequestFloorplan->find('list');
		$clients = $this->JobRequestAssignment->Client->find('list');
		$quotations = $this->JobRequestAssignment->Quotation->find('list');
		$jobRequestRevisions = $this->JobRequestAssignment->JobRequestRevision->find('list');
		$this->set(compact('jobRequestProducts', 'jobRequestFloorplans', 'clients', 'quotations', 'jobRequestRevisions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestAssignment->exists($id)) {
			throw new NotFoundException(__('Invalid job request assignment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestAssignment->save($this->request->data)) {
				$this->Session->setFlash(__('The job request assignment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request assignment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestAssignment.' . $this->JobRequestAssignment->primaryKey => $id));
			$this->request->data = $this->JobRequestAssignment->find('first', $options);
		}
		$jobRequestProducts = $this->JobRequestAssignment->JobRequestProduct->find('list');
		$jobRequestFloorplans = $this->JobRequestAssignment->JobRequestFloorplan->find('list');
		$clients = $this->JobRequestAssignment->Client->find('list');
		$quotations = $this->JobRequestAssignment->Quotation->find('list');
		$jobRequestRevisions = $this->JobRequestAssignment->JobRequestRevision->find('list');
		$this->set(compact('jobRequestProducts', 'jobRequestFloorplans', 'clients', 'quotations', 'jobRequestRevisions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestAssignment->id = $id;
		if (!$this->JobRequestAssignment->exists()) {
			throw new NotFoundException(__('Invalid job request assignment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestAssignment->delete()) {
			$this->Session->setFlash(__('The job request assignment has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request assignment could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	// MODIFICATION: [ M A E ]
	/*
	 *	~ASSIGNING DESIGNER TO A REVISION~
	 *	PROCESS:
	 *		1. Add Job Request Assignment [ jrp / fp ]
	 *		2. ADD Job Request Log for
	 *			2.1. Job Request Revision - Assigned
			3. Get All assignments for this revision if all are assigned,
				3.1. If false, Check all revisions of this job request
				3.2. Get all Assignments for all other revisions of this jobrequest if atleast 1 was assigned
	    		3.2. Check for JOB REQUEST if "status"=="pending"
	    		3.3. If "status"=="pending", update JOB REQUEST to "ongoing"
	 */
    public function add_designer() {
    	$this->autoRender = false;
    	$this->loadModel('JobRequest');
    	$this->loadModel('JobRequestLog');
    	$this->loadModel('JobRequestRevision');
    	
    	$data = $this->request->data;
    	$userin = $this->Auth->user('id');
    	$jr_rev_id = $data['jr_rev_id'];
    	$designer = $data['select_designer'];
    	$tasks = $data['tasks'];
    	$type = $data['type'];
    	$job_request_product_id = $data['job_request_product_id'];
    	$designer_name = $data['designer_name'];
    	$sales_executive_id = $data['sales_executive_id'];
    	$client_id = $data['client_id'];
    	$quotation_id = $data['quotation_id'];
    	$job_request_floorplan_id = $data['job_request_floorplan_id'];
    	$job_request_id = $data['job_request_id'];
    	$quotation_product_id = $data['quotation_product_id'];
    	
    	$this->loadModel('User');
    	$sales = $this->User->findById($sales_executive_id);
    	if(!empty($sales)) {
	    	$sales_executive = $sales['User']['first_name']." ".$sales['User']['last_name'];
    	}
    	else { $sales_executive = ""; }
    	
    	// JOB REQUEST ASSIGNMENT
    	// ===================================================================>
    	if($type=="jrp") {
    		// job request product
	    	$job_request_assignment_set = ['job_request_product_id'=>$job_request_product_id,
	    								   'designer'=>$designer,
	    								   'designer_name'=>$designer_name,
	    								   'sales_executive'=>$sales_executive,
	    								   'assigned_by'=>$userin,
	    								   'client_id'=>$client_id,
	    								   'quotation_id'=>$quotation_id,
	    								   'assigned_task'=>$tasks,
	    								   'status'=>'new',
	    								   'job_request_revision_id'=>$jr_rev_id ];
    	}
    	else {
    		// floor plan
    		$job_request_assignment_set = ['job_request_floorplan_id'=>$job_request_floorplan_id,
	    								   'designer'=>$designer,
	    								   'designer_name'=>$designer_name,
	    								   'assigned_by'=>$userin,
	    								   'assigned_task'=>$tasks,
	    								   'status'=>'new',
	    								   'job_request_revision_id'=>$jr_rev_id ];
    	}
    	$DS_JobRequestAssignment = $this->JobRequestAssignment->getDataSource();
    	$DS_JobRequestAssignment->begin();
    	$this->JobRequestAssignment->create();
    	$this->JobRequestAssignment->set($job_request_assignment_set);
    	if($this->JobRequestAssignment->save()) {
    		echo "JobRequestAssignment save";
    		$job_request_assignment_id = $this->JobRequestAssignment->getLastInsertId();
    		
			// 3. Get All assignments for this revision if all are assigned,
				// 3.1. If false, Check all revisions of this job request
				// 3.2. Get all Assignments for all other revisions of this jobrequest if atleast 1 was assigned
				// 3.2. Check for JOB REQUEST if "status"=="pending"
				// 3.3. If "status"=="pending", update JOB REQUEST to "ongoing"
    		
    		$designer_count = 0;
    		$getAllJobRequestAssignments = $this->JobRequestAssignment->findAllByJobRequestRevisionId($jr_rev_id,
    			['id', 'job_request_revision_id', 'designer']);
    		foreach($getAllJobRequestAssignments as $retAllJobRequestAssignments) {
    			$JobRequestAssignment = $retAllJobRequestAssignments['JobRequestAssignment'];
    			$JobRequestAssignment_designer = $JobRequestAssignment['designer'];
    			
    			if($JobRequestAssignment_designer!="" &&
    			   $JobRequestAssignment_designer!=null)
    			{ $designer_count++; }
    		}
    		
    		if($designer_count!=0) {
    			$Rev_AllHaveDesigner = 0;
		    	$getAllJobRequestRevisions = $this->JobRequestRevision->find('all',
		    	['contain'=>'JobRequestAssignment'],
		    	['conditions'=>['job_request_id'=>$job_request_id]],
		    	['fields'=>'id']);
		    	
		    	foreach($getAllJobRequestRevisions as $retAllJobRequestRevisions) {
		    		$Revision_JobRequestAssignment = $retAllJobRequestRevisions['JobRequestAssignment'];
		    		foreach($Revision_JobRequestAssignment as $retRevision_JobRequestAssignment) {
		    			$JobRequestAssignment_designer = $retRevision_JobRequestAssignment['designer'];
		    			
		    			if($JobRequestAssignment_designer!="" &&
		    			   $JobRequestAssignment_designer!=null)
		    			{ $Rev_AllHaveDesigner++; }
		    		}
		    	}
		    	
		    	if($Rev_AllHaveDesigner!=0) {
		    		$this->JobRequest->recursive = -1;
		    		$getJobRequest = $this->JobRequest->findById($job_request_id, ['id', 'status']);
		    		if(!empty($getJobRequest)) {
		    			$JobRequest_status = $getJobRequest['JobRequest']['status'];
		    			if($JobRequest_status == "pending") {
		    				$DS_JobRequest = $this->JobRequest->getDataSource();
		    				$DS_JobRequest->begin();
		    				$this->JobRequest->id = $job_request_id;
		    				$this->JobRequest->set(['status'=>'ongoing']);
		    				if($this->JobRequest->save()) {
		    					echo "JobRequest saved";
		    					
		    					if($type=="jrp") {
						    		// job request product
							    	$job_request_log_set_ONGOING = ['user_id'=>$userin,
							    							'job_request_id'=>$job_request_id,
							    							'job_request_product_id'=>$job_request_product_id,
							    							'job_request_assignment_id'=>$job_request_assignment_id,
							    							'status'=>'ongoing',
							    							'activity'=>'Job Request - ONGOING',
							    							'quotation_product_id'=>$quotation_product_id,
							    							'job_request_revision_id'=>$jr_rev_id ];
						    	}
						    	else {
						    		// floor plan
							    	$job_request_log_set_ONGOING = ['job_request_id'=>$job_request_id,
							    							'user_id'=>$userin,
							    							'job_request_floorplan_id'=>$job_request_floorplan_id,
							    							'job_request_assignment_id'=>$job_request_assignment_id,
							    							'status'=>'ongoing',
							    							'activity'=>'Job Request - ONGOING',
							    							'job_request_revision_id'=>$jr_rev_id ];
						    	}
						    	
						    	$DS_JobRequestLog_ongoing = $this->JobRequestLog->getDataSource();
								$DS_JobRequestLog_ongoing->begin();
								$this->JobRequestLog->create();
								$this->JobRequestLog->set($job_request_log_set_ONGOING);
								if($this->JobRequestLog->save()) {
									echo "JobRequestLog Ongoing save";
									$DS_JobRequestLog_ongoing->commit();
			    					$DS_JobRequest->commit();
								}
								else {
									echo "Error in JobRequestLog Ongoing";
									$DS_JobRequestLog_ongoing->rollback();
			    					$DS_JobRequest->rollback();
								}
		    				}
		    				else {
		    					echo "Error in JobRequest";
		    					$DS_JobRequest->rollback();
		    				}
		    			}
			    	}
			    	else { $DS_JobRequestAssignment->commit(); }
		    	}
    		}
    		
			// JOB REQUEST LOG
	  //  	===================================================================>
	    	if($type=="jrp") {
	    		// job request product
		    	$job_request_log_set = ['user_id'=>$userin,
		    							'job_request_id'=>$job_request_id,
		    							'job_request_product_id'=>$job_request_product_id,
		    							'job_request_assignment_id'=>$job_request_assignment_id,
		    							'status'=>'new',
		    							'activity'=>'Job Request Assignment - ADD',
		    							'quotation_product_id'=>$quotation_product_id,
		    							'job_request_revision_id'=>$jr_rev_id ];
	    	}
	    	else {
	    		// floor plan
		    	$job_request_log_set = ['job_request_id'=>$job_request_id,
		    							'user_id'=>$userin,
		    							'job_request_floorplan_id'=>$job_request_floorplan_id,
		    							'job_request_assignment_id'=>$job_request_assignment_id,
		    							'status'=>'new',
		    							'activity'=>'Job Request Assignment - ADD',
		    							'job_request_revision_id'=>$jr_rev_id ];
	    	}
	    	
			$DS_JobRequestLog = $this->JobRequestLog->getDataSource();
			$DS_JobRequestLog->begin();
			$this->JobRequestLog->create();
			$this->JobRequestLog->set($job_request_log_set);
			if($this->JobRequestLog->save()) {
				echo "JobRequestLog save";
				$DS_JobRequestLog->commit();
	    		$DS_JobRequestAssignment->commit();
			}
			else {
				echo "Error in JobRequestLog";
				$DS_JobRequestLog->rollback();
	    		$DS_JobRequestAssignment->rollback();
			}
    	}
    	else {
    		echo "Error in JobRequestAssignment";
    		$DS_JobRequestAssignment->rollback();
    	}
    	
    	return "Everything executed"; 
    }
    
    // DESIGNER REJECT, HOLD, AND ACCOMPLISHED ASSIGNMENT
    /*
     *	PROCESS:
     *		1. Update status job request assignment,
     * 			1.1 if status == "rejected" update "date_rejected" to today
     *			1.2 comment provided for accomplished.
     *		2. Add to job request logs,
    */
    public function action() {
    	$this->autoRender = false;
    	$this->loadModel('JobRequest');
    	$this->loadModel('JobRequestProduct');
    	$this->loadModel('JobRequestRevision');
    	$this->loadModel('JobRequestLog');
    	$this->loadModel('JobRequestFloorplan');
    	
    	$today = date("Y-m-d H:m:s");
    	$userin = $this->Auth->user('id');
    	$data = $this->request->data;
    	$type = $data['btntype'];
    	$assigment_id = $data['assignment_id'];
    	$job_request_floorplan_id = $data['job_request_floorplan_id'];
    	$job_request_product_id = $data['job_request_product_id'];
    	$job_request_revision_id = $data['job_request_revision_id'];
    	$job_request_id = $data['job_request_id'];
        $quotation_product_id=$data['quotation_product_id'];
    	
    	// JOB REQUEST ASSIGNMENT
    	// ==================================================================>
    	if($type == "started") {
    		// S T A R T E D
	    	$job_request_assignment_set = ['status'=>'started',
	    								   'date_started'=>$today];
			$activity = 'Job Request Assignment - Started';
    	}
    	elseif($type == "rejected") {
    		// R E J E C T E D
	    	$job_request_assignment_set = ['status'=>'rejected',
	    									  'date_rejected'=>$today];
			$activity = 'Job Request Assignment - Rejected';
    	}
    	elseif($type == "onhold") {
    		// O N H O L D
    		$job_request_assignment_set = ['status'=>'onhold'];
    		$activity = 'Job Request Assignment - On Hold';
    	}
    	elseif($type == "accomplished") {
    		// A C C O M P L I S H E D
    		$job_request_assignment_set = ['status'=>'accomplished',
    									   'date_end'=>$today];
    		$activity = 'Job Request Assignment - Accomplished';
		}
    	else {
    		// C A N C E L L E D
    		$job_request_assignment_set = ['status'=>'cancelled'];
    		$activity = 'Job Request Assignment - Cancelled';
    	}
    									  
    	$DS_JobRequestAssignment = $this->JobRequestAssignment->getDataSource();
    	$DS_JobRequestAssignment->begin();
    	$this->JobRequestAssignment->id = $assigment_id;
    	$this->JobRequestAssignment->set($job_request_assignment_set);
    	if($this->JobRequestAssignment->save()) {
    		echo "JobRequestAssignment saved";
    		
    		// JOB REQUEST LOG
    		// ===============================================================>
    		$job_request_log_set = [
    							'user_id'=>$userin,
    							'job_request_floorplan_id'=>$job_request_floorplan_id,
    							'job_request_product_id'=>$job_request_product_id,
    							'job_request_assignment_id'=>$assigment_id,
    							'status'=>$type,
    							'activity'=>$activity,
    							'job_request_revision_id'=>$job_request_revision_id,
                            	'job_request_id'=>$job_request_id,
                                'quotation_product_id'=>$quotation_product_id
    							];
    							
    		$DS_JobRequestLog = $this->JobRequestLog->getDataSource();
    		$DS_JobRequestLog->begin();
    		$this->JobRequestLog->create();
    		$this->JobRequestLog->set($job_request_log_set);
    		if($this->JobRequestLog->save()) {
				echo "JobRequestLog saved";
				if($type == "started") {
					echo "-FROM STARTED-";
					// The goal is to set job_request_product to 'ongoing'
					// if at least 1 from job_request_revisions >> job_request_assignments
					// has been started.
					
					if($job_request_floorplan_id==0) {
						// Get all job_request_revision with this job_request_product_id
						$getAllJRV_JRP = $this->JobRequestRevision->find('all',
							['conditions'=>['job_request_product_id'=>$job_request_product_id],
							 'fields'=>['JobRequestRevision.id', 'JobRequestRevision.job_request_product_id']]);
						
						$is1Started = 0;
						foreach($getAllJRV_JRP as $retAllJRV_JRP) {
							$JobRequestAssignment2 = $retAllJRV_JRP['JobRequestAssignment'];
							foreach($JobRequestAssignment2 as $eachJobRequestAssignment2) {
								$assignment_status = $eachJobRequestAssignment2['status'];
								echo $assignment_status;
								if($assignment_status == "started") {
									$is1Started++;
									echo $is1Started;
								}
							}
						}
						
						if($is1Started==1) {
							echo "=Is 1 Started=";
							$DS_JobRequestProduct1 = $this->JobRequestProduct->getDataSource();
							$DS_JobRequestProduct1->begin();
							$this->JobRequestProduct->id = $job_request_product_id;
							$this->JobRequestProduct->set(['status'=>'ongoing']);
							if($this->JobRequestProduct->save()) {
								echo "-JOB REQUEST PRIDUCT STATUS UPDATED TO ONGOING-";
								$DS_JobRequestProduct1->commit();
							}
							else {
								echo "-ERROR IN UPDATING JOB REQUEST PRODUCT STATUS TO ONGOING";
								$DS_JobRequestProduct1->rollback();
							}
						}
					}
					else {
						// Get all job_request_revision with this job_request_product_id
						$getAllJRV_JRP = $this->JobRequestRevision->find('all',
							['conditions'=>['job_request_floorplan_id'=>$job_request_floorplan_id],
							 'fields'=>['JobRequestRevision.id', 'JobRequestRevision.job_request_floorplan_id']]);
						
						$is1Started = 0;
						foreach($getAllJRV_JRP as $retAllJRV_JRP) {
							$JobRequestAssignment2 = $retAllJRV_JRP['JobRequestAssignment'];
							foreach($JobRequestAssignment2 as $eachJobRequestAssignment2) {
								$assignment_status = $eachJobRequestAssignment2['status'];
								echo $assignment_status;
								if($assignment_status == "started") {
									$is1Started++;
									echo $is1Started;
								}
							}
						}
						
						if($is1Started==1) {
							echo "=Is 1 Started=";
							$DS_JobRequestProduct1 = $this->JobRequestFloorplan->getDataSource();
							$DS_JobRequestProduct1->begin();
							$this->JobRequestFloorplan->id = $job_request_floorplan_id;
							$this->JobRequestFloorplan->set(['status'=>'ongoing']);
							if($this->JobRequestFloorplan->save()) {
								echo "-JOB REQUEST PRIDUCT STATUS UPDATED TO ONGOING-";
								$DS_JobRequestProduct1->commit();
							}
							else {
								echo "-ERROR IN UPDATING JOB REQUEST PRODUCT STATUS TO ONGOING";
								$DS_JobRequestProduct1->rollback();
							}
						}
					}
				}
				elseif($type == "accomplished" || $type=="rejected") {
					// Check all assignment of revision if all have "date_end" and status != "rejected"
					$countAllAssignments = $this->JobRequestAssignment->find('count',
		    			['conditions'=>['job_request_revision_id'=>$job_request_revision_id,
		    						    'NOT'=>['JobRequestAssignment.status'=>'rejected']],
		    			 'fields'=>['id','date_end', 'status']]);
		    		$countDateEndsAssignment = $this->JobRequestAssignment->find('count',
		    			['conditions'=>['job_request_revision_id'=>$job_request_revision_id,
		    							'NOT'=>['JobRequestAssignment.status'=>'rejected','date_end'=>null]],
		    			 'fields'=>['id', 'date_end']]);
		    			 
		    		// Update "actual_date_finished" on revision to "today"
		    		if($countAllAssignments==$countDateEndsAssignment) {
		    			$DS_JobRequestRevision = $this->JobRequestRevision->getDataSource();
		    			$DS_JobRequestRevision->begin();
		    			
		    			$this->JobRequestRevision->id = $job_request_revision_id;
		    			$this->JobRequestRevision->set(['actual_date_finished'=>$today]);
		    			if($this->JobRequestRevision->save()) {
		    				echo "JobRequestRevision saved";
		    				// J O B  R E Q U E S T  S T A R T S  H E R E
		    				// ==============================================================================================================================> JOB REQUEST HERE
	    					if($job_request_floorplan_id==0) {
	    						// The goal is to update job_request_product status
	    						// to ongoing if all job_request_revisions have
	    						// actual_date_finished
	    						
	    						$this->JobRequestRevision->recursive = -1;
	    						$getJRV_2 = $this->JobRequestRevision->findAllByJobRequestProductId($job_request_product_id,
	    							['JobRequestRevision.id', 'JobRequestRevision.actual_date_finished',
	    							 'JobRequestRevision.job_request_product_id']);
	    							
	    						$JRV_with_actual_date_finished = 0;
	    						$JRV_with_and_without = 0;
	    						foreach($getJRV_2 as $retJRV_2) {
	    							$JRV_2 = $retJRV_2['JobRequestRevision'];
	    							$actual_date_finished_2 = $JRV_2['actual_date_finished'];
	    							if($actual_date_finished_2!=null) {
		    							$JRV_with_actual_date_finished++;
	    							}
	    							$JRV_with_and_without++;
	    						}
	    						
	    						if($JRV_with_and_without == $JRV_with_actual_date_finished) {
	    							$this->JobRequestProduct->id = $job_request_product_id;
	    							$this->JobRequestProduct->set(['status'=>'accomplished']);
	    							if($this->JobRequestProduct->save()) {
	    								echo "-Job request product set to accomplished-";
	    							}
	    							else {
	    								echo "-Job request product not set to accomplished-";
	    							}
	    						}
	    						else {
	    							echo "Job Request Product should not be accomplished yet.";
	    						}
	    						
			    				// Check all revision of this Job Request Product if all have "actual_date_finished"
			    				// and status != declined
			    				$this->JobRequestRevision->recursive = -1;
			    				$countAllJobRequestProduct = $this->JobRequestRevision->find('count',
			    					['conditions'=>['job_request_id'=>$job_request_id],
			    					 'fields'=>['id', 'job_request_id', 'status']]);
			    				
			    				$this->JobRequestRevision->recursive = -1;
			    				$countAllEndsJobRequestProduct = $this->JobRequestRevision->find('count',
			    					['conditions'=>['job_request_id'=>$job_request_id,
			    									'NOT'=>['actual_date_finished'=>null]],
			    					 'fields'=>['id', 'job_request_id', 'actual_date_finished',
			    							    'status']]);
			    				// =====================================> here
			    				if($countAllJobRequestProduct==$countAllEndsJobRequestProduct) {
			    					echo "JobRequest Product Count passed";
			    					echo "Job Request Product ALL ACTUAL_DATE_FINISHED";
			    					
			    					$DS_JobRequestProduct = $this->JobRequestProduct->getDataSource();
			    					$DS_JobRequestProduct->begin();
			    					
			    					$this->JobRequestProduct->id = $job_request_product_id;
			    					$this->JobRequestProduct->set(['status'=>'accomplished',
			    												   'date_accomplished'=>$today]);
			    					if($this->JobRequestProduct->save()) {
			    						echo "JobRequestProduct saved";
			    						// Add JobRequestProduct accomplished log
			    						$log_jrp_set = ['user_id'=>$userin,
						    							'job_request_floorplan_id'=>$job_request_floorplan_id,
						    							'job_request_product_id'=>$job_request_product_id,
						    							'job_request_assignment_id'=>$assigment_id,
						    							'status'=>$type,
						    							'activity'=>"Job Request Product - Accomplished",
						    							'job_request_revision_id'=>$job_request_revision_id,
						                            	'job_request_id'=>$job_request_id,
						                                'quotation_product_id'=>$quotation_product_id
						    							];
							    							
							    		$Log_JRP = $this->JobRequestLog->getDataSource();
			    						$Log_JRP->begin();
			    						
							    		$this->JobRequestLog->create();
							    		$this->JobRequestLog->set($log_jrp_set);
							    		if($this->JobRequestLog->save()) {
							    			echo "Log JRP saved";
							    			// Check all JobRequestProduct in JobRequest if all have "date_accomplished"
							    			$this->JobRequestProduct->recursive = -1;
							    			$countAllJobRequestProduct = $this->JobRequestProduct->find('count',
							    				['conditions'=>['job_request_id'=>$job_request_id],
							    				 'fields'=>['id', 'job_request_id', 'status',
							    							'date_accomplished']]);
							    			
							    			$this->JobRequestProduct->recursive = -1;
							    			$countAllEndsJobRequestProduct = $this->JobRequestProduct->find('count',
							    				['conditions'=>['job_request_id'=>$job_request_id,
							    								'status'=>'accomplished',
							    								'NOT'=>['date_accomplished'=>null]],
							    				 'fields'=>['id', 'job_request_id', 'status',
							    							'date_accomplished']]);
							    							
							    			// Update JobRequestProduct to accomplished
							    			if($countAllJobRequestProduct==$countAllEndsJobRequestProduct) {
								    			$DS_JobRequest = $this->JobRequest->getDataSource();
								    			$DS_JobRequest->begin();
								    			$this->JobRequest->id = $job_request_id;
								    			$this->JobRequest->set(['status'=>'accomplished']);
								    			if($this->JobRequest->save()) {
								    				echo "JobRequest save";
								    				// LOG FOR JOB REQUEST
								    				$log_jr_set = [
									    							'user_id'=>$userin,
									    							'job_request_floorplan_id'=>$job_request_floorplan_id,
									    							'job_request_product_id'=>$job_request_product_id,
									    							'job_request_assignment_id'=>$assigment_id,
									    							'status'=>$type,
									    							'activity'=>"Job Request - Accomplished",
									    							'job_request_revision_id'=>$job_request_revision_id,
									                            	'job_request_id'=>$job_request_id,
									                                'quotation_product_id'=>$quotation_product_id
									    							];
										    							
										    		$Log_JR = $this->JobRequestLog->getDataSource();
						    						$Log_JR->begin();
						    						
										    		$this->JobRequestLog->create();
										    		$this->JobRequestLog->set($log_jr_set);
										    		if($this->JobRequestLog->save()) {
										    			echo "Log JRP saved";
										    			$Log_JR->commit();
									    				$DS_JobRequest->commit();
										    			$Log_JRP->commit();
							    						$DS_JobRequestProduct->commit();
									    				$DS_JobRequestRevision->commit();
										    		}
										    		else {
										    			echo "ERROR IN LOG JR saved";
										    			$Log_JR->rollback();
														$DS_JobRequest->rollback();
														$Log_JRP->rollback();
														$DS_JobRequestProduct->rollback();
														$DS_JobRequestRevision->rollback();
										    		}
								    			}
								    			else {
								    				echo "Error in JobRequest";
								    				$DS_JobRequest->rollback();
									    			$Log_JRP->rollback();
						    						$DS_JobRequestProduct->rollback();
								    				$DS_JobRequestRevision->rollback();
								    			}
							    			}
							    			else {
							    				$Log_JRP->commit();
							    				$DS_JobRequestProduct->commit();
						    					$DS_JobRequestRevision->commit();
							    			}
							    		}
							    		else {
							    			echo "Error in Log JobRequestProduct";
							    			$Log_JRP->rollback();
				    						$DS_JobRequestProduct->rollback();
						    				$DS_JobRequestRevision->rollback();
							    		}
			    					}
			    					else {
			    						echo "Error in JobRequestProduct";
			    						$DS_JobRequestProduct->rollback();
					    				$DS_JobRequestRevision->rollback();
			    					}
			    				} // ======================> here
			    				else {
			    					echo "$countAllJobRequestProduct-$countAllEndsJobRequestProduct";
			    					$DS_JobRequestRevision->commit();
			    				}
    						}
		    				// J O B  R E Q U E S T  E N D S  H E R E
		    				
		    				// F L O O R  P L A N  S T A R T S  H E R E
		    				// ==============================================================================================================================> FLOOR PLAN HERE
                            else {
                            	// The goal is to update job_request_floorplan status
	    						// to ongoing if all job_request_revisions have
	    						// actual_date_finished
	    						
	    						$this->JobRequestRevision->recursive = -1;
	    						$getJRV_2 = $this->JobRequestRevision->findAllByJobRequestFloorplanId($job_request_floorplan_id,
	    							['JobRequestRevision.id', 'JobRequestRevision.actual_date_finished',
	    							 'JobRequestRevision.job_request_floorplan_id']);
	    							
	    						$JRV_with_actual_date_finished = 0;
	    						$JRV_with_and_without = 0;
	    						foreach($getJRV_2 as $retJRV_2) {
	    							$JRV_2 = $retJRV_2['JobRequestRevision'];
	    							$actual_date_finished_2 = $JRV_2['actual_date_finished'];
	    							if($actual_date_finished_2!=null) {
		    							$JRV_with_actual_date_finished++;
	    							}
	    							$JRV_with_and_without++;
	    						}
	    						
	    						if($JRV_with_and_without == $JRV_with_actual_date_finished) {
	    							$this->JobRequestFloorplan->id = $job_request_floorplan_id;
	    							$this->JobRequestFloorplan->set(['status'=>'accomplished']);
	    							if($this->JobRequestFloorplan->save()) {
	    								echo "-Job request floor plan set to accomplished-";
	    							}
	    							else {
	    								echo "-Job request floor plan not set to accomplished-";
	    							}
	    						}
	    						else {
	    							echo "Job Request Floor Plan should not be accomplished yet.";
	    						}
                            	
                            	// Check all revision of this Job Request Product if all have "actual_date_finished"
			    				// and status != declined
			    				$this->JobRequestRevision->recursive = -1;
			    				$countAllJobRequestProduct = $this->JobRequestRevision->find('count',
			    					['conditions'=>['job_request_id'=>$job_request_id],
			    					 'fields'=>['id', 'job_request_id', 'status']]);
			    				
			    				$this->JobRequestRevision->recursive = -1;
			    				$countAllEndsJobRequestProduct = $this->JobRequestRevision->find('count',
			    					['conditions'=>['job_request_id'=>$job_request_id,
			    									'NOT'=>['actual_date_finished'=>null]],
			    					 'fields'=>['id', 'job_request_id', 'actual_date_finished',
			    							    'status']]);
			    				if($countAllJobRequestProduct==$countAllEndsJobRequestProduct) {
				    					
			    					echo "FOR FLOOR PLAN";
			    					$DS_JobRequestFloorplan = $this->JobRequestFloorplan->getDataSource();
			    					$DS_JobRequestFloorplan->begin();
			    					
			    					$this->JobRequestFloorplan->id = $job_request_floorplan_id;
			    					$this->JobRequestFloorplan->set(['status'=>'accomplished',
			    												     'date_accomplished'=>$today]);
			    					if($this->JobRequestFloorplan->save()) {
			    						echo "JobRequestFloorplan saved";
			    						// Add JobRequestProduct accomplished log
			    						$log_fp_set = ['user_id'=>$userin,
						    							'job_request_floorplan_id'=>$job_request_floorplan_id,
						    							'job_request_product_id'=>$job_request_product_id,
						    							'job_request_assignment_id'=>$assigment_id,
						    							'status'=>$type,
						    							'activity'=>"Job Request Floorplan - Accomplished",
						    							'job_request_revision_id'=>$job_request_revision_id,
						                            	'job_request_id'=>$job_request_id,
						                                'quotation_product_id'=>$quotation_product_id
						    							];
							    							
							    		$Log_FP = $this->JobRequestLog->getDataSource();
			    						$Log_FP->begin();
			    						
							    		$this->JobRequestLog->create();
							    		$this->JobRequestLog->set($log_fp_set);
							    		if($this->JobRequestLog->save()) {
							    			echo "Log FP saved";
							    			// Check all JobRequestFloorplan in JobRequest if all have "date_accomplished"
							    			$this->JobRequestFloorplan->recursive = -1;
							    			$countAllJobRequestFloorplan = $this->JobRequestFloorplan->find('count',
							    				['conditions'=>['job_request_id'=>$job_request_id],
							    				 'fields'=>['id', 'job_request_id', 'status',
							    							'date_accomplished']]);
							    			
							    			$this->JobRequestFloorplan->recursive = -1;
							    			$countAllEndsJobRequestFloorplan = $this->JobRequestFloorplan->find('count',
							    				['conditions'=>['job_request_id'=>$job_request_id,
							    								'status'=>'accomplished',
							    								'NOT'=>['date_accomplished'=>null]],
							    				 'fields'=>['id', 'job_request_id', 'status',
							    							'date_accomplished']]);
							    							
							    			// Update JobRequestProduct to accomplished
							    			if($countAllJobRequestFloorplan==$countAllEndsJobRequestFloorplan) {
								    			$DS_JobRequest = $this->JobRequest->getDataSource();
								    			$DS_JobRequest->begin();
								    			$this->JobRequest->id = $job_request_id;
								    			$this->JobRequest->set(['status'=>'accomplished']);
								    			if($this->JobRequest->save()) {
								    				echo "JobRequest save";
								    				// LOG FOR JOB REQUEST
								    				$log_jr_set = [
									    							'user_id'=>$userin,
									    							'job_request_floorplan_id'=>$job_request_floorplan_id,
									    							'job_request_product_id'=>$job_request_product_id,
									    							'job_request_assignment_id'=>$assigment_id,
									    							'status'=>$type,
									    							'activity'=>"Job Request - Accomplished",
									    							'job_request_revision_id'=>$job_request_revision_id,
									                            	'job_request_id'=>$job_request_id,
									                                'quotation_product_id'=>$quotation_product_id
									    							];
										    							
										    		$Log_JR = $this->JobRequestLog->getDataSource();
						    						$Log_JR->begin();
						    						
										    		$this->JobRequestLog->create();
										    		$this->JobRequestLog->set($log_jr_set);
										    		if($this->JobRequestLog->save()) {
										    			echo "Log JRP saved";
										    			$Log_JR->commit();
									    				$DS_JobRequest->commit();
										    			$Log_FP->commit();
							    						$DS_JobRequestFloorplan->commit();
									    				$DS_JobRequestRevision->commit();
										    		}
										    		else {
										    			echo "ERROR IN LOG JR saved";
										    			$Log_JR->rollback();
														$DS_JobRequest->rollback();
														$Log_FP->rollback();
														$DS_JobRequestFloorplan->rollback();
														$DS_JobRequestRevision->rollback();
										    		}
								    			}
								    			else {
								    				echo "Error in JobRequest";
								    				$DS_JobRequest->rollback();
									    			$Log_FP->rollback();
						    						$DS_JobRequestFloorplan->rollback();
								    				$DS_JobRequestRevision->rollback();
								    			}
							    			}
							    			else {
							    				$Log_FP->commit();
							    				$DS_JobRequestFloorplan->commit();
						    					$DS_JobRequestRevision->commit();
							    			}
							    		}
							    		else {
							    			echo "Error in Log JobRequestFloorplan";
							    			$Log_FP->rollback();
				    						$DS_JobRequestFloorplan->rollback();
						    				$DS_JobRequestRevision->rollback();
							    		}
			    					}
			    					else {
			    						echo "Error in JobRequestFloorplan";
			    						$DS_JobRequestFloorplan->rollback();
					    				$DS_JobRequestRevision->rollback();
			    					}
			    				}
			    				else {
			    					echo "$countAllJobRequestProduct-$countAllEndsJobRequestProduct";
			    					$DS_JobRequestRevision->commit();
			    				}
                            }
		    				// F L O O R  P L A N  E N D S  H E R E
		    				// ==============================================================================================================================> FLOOR PLAN HERE
		    			}
		    			else {
		    				echo "Error RequestRevision";
		    				$DS_JobRequestRevision->rollback();
		    			}
		    		}
				}
    			$DS_JobRequestLog->commit();
	    		$DS_JobRequestAssignment->commit();
    		}
    		else {
    			echo "Error in JobRequestLog";
    			$DS_JobRequestLog->rollback();
	    		$DS_JobRequestAssignment->rollback();
    		}
    	}
    	else {
    		echo "Error in JobRequestAssignment";
    		$DS_JobRequestAssignment->rollback();
    	}
    	
    	return "Everything has been executed";
    }
    
    // DESIGNER ESTIMATES ASSIGNMENT
    /*
    	PROCESS:
    		1. Update Assignment
	    	2. Check if all have estimated finish date
	    	3. If all have estimated_finish_date, get max(estimated_finish_date)
	    	4. After getting max estimation update JobRequestRevision estimated_finish_date
	    	5. LOGS
    */
    public function estimate() {
    	$this->autoRender = false;
    	
    	$this->loadModel('JobRequestRevision');
    	$this->loadModel('JobRequestLog');
    	
    	$today = date("Y-m-d H:m:s");
    	
    	$userin = $this->Auth->user('id');
    	$data = $this->request->data;
    	$assignment_id = $data['assignment_id'];
    	$job_request_id = $data['job_request_id'];
        $quotation_product_id=$data['quotation_product_id'];
    	$job_request_floorplan_id = $data['job_request_floorplan_id'];
    	$job_request_product_id = $data['job_request_product_id'];
    	$job_request_revision_id = $data['job_request_revision_id'];
    	$input_estimated_finish = $data['input_estimated_finish'];
    	$input_time = $data['input_time'];
		$date_time_finish = date("Y-m-d H:m:i", strtotime($input_estimated_finish." ".$input_time));
    	
    	// 1. Update Assignment
    	$job_request_assignment_set = ['estimated_finish_date'=>$date_time_finish];
    	$DS_JobRequestAssignment = $this->JobRequestAssignment->getDataSource();
    	$DS_JobRequestAssignment->begin();
    	
    	$this->JobRequestAssignment->id = $assignment_id;
    	$this->JobRequestAssignment->set($job_request_assignment_set);
    	
    	if($this->JobRequestAssignment->save()) {
    		// 2. Check if all have estimated finish date
    		$this->JobRequestAssignment->recursive = -1;
    		$getAllAssignments = $this->JobRequestAssignment->find('all',
    			['conditions'=>['job_request_revision_id'=>$job_request_revision_id,
    							'estimated_finish_date'=>null],
    			 'fields'=>['id','estimated_finish_date']]);
    		
    		if(count($getAllAssignments)==0) {
    			echo "All have estimated_finish_date";
    			// 3. If all have estimated_finish_date, get max(estimated_finish_date)
    			$this->JobRequestAssignment->recursive = -1;
    			$getMaxAssignment = $this->JobRequestAssignment->find('all',
    				['conditions'=>['job_request_revision_id'=>$job_request_revision_id],
    				 'fields'=>['MAX(estimated_finish_date) as estimated_finish_date',
    							'id',
    							'job_request_revision_id']]);
    			
    			// 4. After getting max estimation update JobRequestRevision estimated_finish_date
    			foreach($getMaxAssignment as $retMaxAssignment) {
    				$max_estimated_finish_date = date("Y-m-d H:m:s", strtotime($retMaxAssignment[0]['estimated_finish_date']));
    				$DS_JobRequestRevision = $this->JobRequestRevision->getDataSource();
    				$DS_JobRequestRevision->begin();
    				
    				$this->JobRequestRevision->id = $job_request_revision_id;
    				$this->JobRequestRevision->set(['estimated_finish'=>$max_estimated_finish_date]);
    				if($this->JobRequestRevision->save()) {
    					echo "JobRequestRevision saved";
    					// 5. JOB REQUEST LOG
			    		// ===============================================================>
			    		$job_request_log_set = [
			    							'user_id'=>$userin,
			    							'job_request_floorplan_id'=>$job_request_floorplan_id,
			    							'job_request_product_id'=>$job_request_product_id,
			    							'job_request_assignment_id'=>$assignment_id,
			    							'status'=>'estimated',
			    							'activity'=>'Job Request Assignment - Estimated',
			    							'job_request_revision_id'=>$job_request_revision_id,
									    	'job_request_id'=>$job_request_id,
									        'quotation_product_id'=>$quotation_product_id
			    							];
						echo json_encode($job_request_log_set);
						
			    		$DS_JobRequestLog = $this->JobRequestLog->getDataSource();
			    		$DS_JobRequestLog->begin();
			    		$this->JobRequestLog->create();
			    		$this->JobRequestLog->set($job_request_log_set);
			    		if($this->JobRequestLog->save()) {
			    			echo "JobRequestLog saved";
			    			$DS_JobRequestLog->commit();
			    			$DS_JobRequestRevision->commit();
				    		$DS_JobRequestAssignment->commit();	
			    		}
			    		else {
			    			echo "Error in JobRequestLog";
			    			$DS_JobRequestLog->rollback();
			    			$DS_JobRequestRevision->rollback();
				    		$DS_JobRequestAssignment->rollback();
			    		}
    				}
    				else {
    					echo "Error in JobRequestRevision";
    					$DS_JobRequestRevision->rollback();
    					$DS_JobRequestAssignment->rollback();
    				}
    			}
    		}
    		else {
    			echo "Not all have estimated_finish_date";
    			$DS_JobRequestAssignment->commit();
    		}
    	}
    	else {
    		echo "Error JobRequestAssignment";
    		$DS_JobRequestAssignment->rollback();
    	}
    	
    	return "Executed Everything";
    }
    // END OF MODIFICATION: [ M A E ]
}