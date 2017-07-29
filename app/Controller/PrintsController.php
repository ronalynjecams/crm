<?php
App::uses('AppController', 'Controller');
 
/**
 * AgentStatuses Controller
 *
 * @property AgentStatus $AgentStatus
 * @property PaginatorComponent $Paginator
 */
class PrintsController extends AppController {
public $components = array('Mpdf.Mpdf');

    public function testpdf() {
        // initializing mPDF
        $this->Mpdf->init();

        // setting filename of output pdf file
        $this->Mpdf->setFilename('file.pdf');

        // setting output to I, D, F, S
        $this->Mpdf->setOutput('D');

        // you can call any mPDF method via component, for example:
        $this->Mpdf->SetWatermarkText("Draft");
    }
}
