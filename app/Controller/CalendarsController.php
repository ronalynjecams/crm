
<?php
App::uses('AppController', 'Controller');
class CalendarsController extends AppController {
	
	public function collection_schedules(){
	    
	}
	public function get_collection_schedules(){
		$this->autoRender = false;
		$this->response->type('json');
		
        $this->loadModel('CollectionSchedule');
        
        $date_today = date('Y-m-d');
        $this->CollectionSchedule->recursive = 3;
        $collection_scheds = $this->CollectionSchedule->find('all',[
            'conditions'=>[ 
                'CollectionSchedule.status !=' => 'cancelled'
            ],
            // 'fields'=>['CollectionSchedule.id', 'CollectionSchedule.collection_date', 'CollectionSchedule.status', 'CollectionSchedule.expected_amount', 'Quotation.client_id', 'Quotation.user_id']
            ]);
		$json_dates = [];
		foreach($collection_scheds as $collection_sched){
		    
			$json[] = [ 
			    'id' => $collection_sched['CollectionSchedule']['id'],  
			    'title' => $collection_sched['Quotation']['Client']['name'],
			    'start' => $collection_sched['CollectionSchedule']['collection_date'],  
			    'className' => 'mint'
			    ];
			    
			if (!in_array($collection_sched['CollectionSchedule']['collection_date'], $json_dates, true)){
				array_push($json_dates, $collection_sched['CollectionSchedule']['collection_date']); 
			} 
		}
			// $json[] = [ 
			//     'id' => 2,  
			//     'title' => 'asad',
			//     'start' => '2018-04-11',
			//     'className' => 'dark'
			//     ]; 
		$ct = 0;
// 		pr($collection_scheds);exit;
		foreach($json_dates as $jdate){
			$sched = $this->CollectionSchedule->find('all', 
			[ 
			'conditions' => ['CollectionSchedule.status !=' => 'cancelled',
			'CollectionSchedule.collection_date' => $jdate, ],
			'fields' => ['SUM(CollectionSchedule.expected_amount) AS gtotal']]);
			
			$json[] = ['title' => 'Total: ' . number_format($sched[0][0]['gtotal'], 2) , 'start' => $jdate, 'className' => 'dark'];
			return json_encode($json);
			}
		}
}

