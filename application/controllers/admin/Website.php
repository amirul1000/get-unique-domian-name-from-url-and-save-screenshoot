<?php

/**
 * Author: Amirul Momenin
 * Desc:Website Controller
 *
 */
class Website extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('Customlib');
        $this->load->helper(array(
            'cookie',
            'url'
        ));
        $this->load->database();
        $this->load->model('Website_model');
        if (! $this->session->userdata('validated')) {
            redirect('admin/login/index');
        }
    }

    /**
     * Index Page for this controller.
     *
     * @param $start -
     *            Starting of website table's index to get query
     *            
     */
    function index($start = 0)
    {
        $limit = 10;
        $data['website'] = $this->Website_model->get_limit_website($limit, $start);
        // pagination
        $config['base_url'] = site_url('admin/website/index');
        $config['total_rows'] = $this->Website_model->get_count_website();
        $config['per_page'] = 10;
        // Bootstrap 4 Pagination fix
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();

        $data['_view'] = 'admin/website/index';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Save website
     *
     * @param $id -
     *            primary key to update
     *            
     */
    function save($id = - 1)
    {
		$file_image = "";
		$url = '';
		$host = '';
		$dubplicate = 0;
		/*$scheme = parse_url($this->input->post('url'), PHP_URL_SCHEME);
		if(empty($scheme))
		{
			$scheme = "http://";
			$url = $scheme.$this->input->post('url');
			$host = parse_url($url, PHP_URL_HOST);
			echo $url;
			exit;
		}
		else{
			$scheme = $scheme."://";
			$host = parse_url($this->input->post('url'), PHP_URL_HOST);
		}
		*/
		if (isset($_POST) && count($_POST) > 0) {
		$urlarr = preg_split("/\//",trim($this->input->post('url')));
		//print_r($urlarr);
		if($urlarr[0]=="http:" || $urlarr[0]=="https:")
		{
			$url =  $urlarr[0]."//".$urlarr[2];
			$host = $urlarr[2];
		}
		else{
			$url =  "http://".$urlarr[0];
			$host = $urlarr[0];
		}
		$host = str_replace("www.","",$host);
		//$host = parse_url($url, PHP_URL_HOST);
		//echo $urlarr[2];
		//exit;
		
		//echo $host;
		
		/*$this->db->like('url', $host, 'both');
        $result = $this->db->get('website')->result_array();
		//echo $this->db->*/		
		//*exit;
		
		$result = $this->db->get_where('website', array(
							'host' => trim($host)
						))->row_array();
		//echo $this->db->last_query();	
		
		 if(count($result)>0)
		 {
			$dubplicate = 1;
			$data['id'] = $id;
			$data['msg'] = "Duplicate website";
			$data['website'] = $this->Website_model->get_website(0);
			$data['_view'] = 'admin/website/form';
			$this->load->view('layouts/admin/body', $data);
			//exit;
		 }
		
		  
		 $screen_shot_json_data = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
		 $screen_shot_result = json_decode($screen_shot_json_data, true);
		 $screen_shot = $screen_shot_result['screenshot']['data'];
		 $screen_shot = str_replace(array('_','-'), array('/', '+'), $screen_shot);
		 //$screen_shot_image = "<img src=\"data:image/jpeg;base64,".$screen_shot."\" class='img-responsive img-thumbnail'/>"; 
		 // Obtain the original content (usually binary data)
		$bin = base64_decode($screen_shot);
		
		// Load GD resource from binary data
		$im = imagecreatefromstring($bin);
		
		// Make sure that the GD library was able to load the image
		// This is important, because you should not miss corrupted or unsupported images
		if (!$im) {
		  die('Base64 value is not a valid image');
		}
		
		// Specify the location where you want to save the image
		$file_image = "./public/uploads/images/website/".str_replace(".","",$host).".png";
		
		// Save the GD resource as PNG in the best possible quality (no compression)
		// This will strip any metadata or invalid contents (including, the PHP backdoor)
		// To block any possible exploits, consider increasing the compression level
		imagepng($im, $file_image, 0);  
		
		$file_image = str_replace("./public/","",$file_image);
      
		}
		
		if($dubplicate==0){
		//$file_image = "";

        $created_at = "";
        $updated_at = "";

        if ($id <= 0) {
            $created_at = date("Y-m-d H:i:s");
        } else if ($id > 0) {
            $updated_at = date("Y-m-d H:i:s");
        }
		
        $params = array(
            'url' => html_escape(trim($url)),
			'host' => html_escape($host),
            'basic_desc' => html_escape($this->input->post('basic_desc')),
            'category_id' => html_escape($this->input->post('category_id')),
            'contact_person' => html_escape($this->input->post('contact_person')),
            'Mobile' => html_escape($this->input->post('Mobile')),
            'Mobile_2' => html_escape($this->input->post('Mobile_2')),
            'email' => html_escape($this->input->post('email')),
            'facebook' => html_escape($this->input->post('facebook')),
            'rating' => html_escape($this->input->post('rating')),
            'auto_featch' => html_escape($this->input->post('auto_featch')),
            'file_image' => $file_image,
            'active' => html_escape($this->input->post('active')),
            'admin_notes' => html_escape($this->input->post('admin_notes')),
            'order' => html_escape($this->input->post('order')),
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );
		
		
	
        $config['upload_path'] = "./public/uploads/images/website";
        $config['allowed_types'] = "gif|jpg|png";
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (isset($_POST) && count($_POST) > 0) {
            if (strlen($_FILES['file_image']['name']) > 0 && $_FILES['file_image']['size'] > 0) {
                if (! $this->upload->do_upload('file_image')) {
                    $error = array(
                        'error' => $this->upload->display_errors()
                    );
                } else {
                    $file_image = "uploads/images/website/" . $_FILES['file_image']['name'];
                    $params['file_image'] = $file_image;
                }
            }/* else {
                unset($params['file_image']);
            }*/
        }

        if ($id > 0) {
            unset($params['created_at']);
        }
        if ($id <= 0) {
            unset($params['updated_at']);
        }
        $data['id'] = $id;
        // update
        if (isset($id) && $id > 0) {
            $data['website'] = $this->Website_model->get_website($id);
            if (isset($_POST) && count($_POST) > 0) {
                $this->Website_model->update_website($id, $params);
                redirect('admin/website/index');
            } else {
                $data['_view'] = 'admin/website/form';
                $this->load->view('layouts/admin/body', $data);
            }
        } // save
        else {
            if (isset($_POST) && count($_POST) > 0) {
                $website_id = $this->Website_model->add_website($params);
                redirect('admin/website/index');
            } else {
                $data['website'] = $this->Website_model->get_website(0);
                $data['_view'] = 'admin/website/form';
                $this->load->view('layouts/admin/body', $data);
            }
        }
		
		}
    }

    /**
     * Details website
     *
     * @param $id -
     *            primary key to get record
     *            
     */
    function details($id)
    {
        $data['website'] = $this->Website_model->get_website($id);
        $data['id'] = $id;
        $data['_view'] = 'admin/website/details';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Deleting website
     *
     * @param $id -
     *            primary key to delete record
     *            
     */
    function remove($id)
    {
        $website = $this->Website_model->get_website($id);

        // check if the website exists before trying to delete it
        if (isset($website['id'])) {
            $this->Website_model->delete_website($id);
            redirect('admin/website/index');
        } else
            show_error('The website you are trying to delete does not exist.');
    }

    /**
     * Search website
     *
     * @param $start -
     *            Starting of website table's index to get query
     */
    function search($start = 0)
    {
        if (! empty($this->input->post('key'))) {
            $key = $this->input->post('key');
            $_SESSION['key'] = $key;
        } else {
            $key = $_SESSION['key'];
        }

        $limit = 10;
        $this->db->like('id', $key, 'both');
        $this->db->or_like('url', $key, 'both');
        $this->db->or_like('basic_desc', $key, 'both');
        $this->db->or_like('category_id', $key, 'both');
        $this->db->or_like('contact_person', $key, 'both');
        $this->db->or_like('Mobile', $key, 'both');
        $this->db->or_like('Mobile_2', $key, 'both');
        $this->db->or_like('email', $key, 'both');
        $this->db->or_like('facebook', $key, 'both');
        $this->db->or_like('rating', $key, 'both');
        $this->db->or_like('auto_featch', $key, 'both');
        $this->db->or_like('file_image', $key, 'both');
        $this->db->or_like('active', $key, 'both');
        $this->db->or_like('admin_notes', $key, 'both');
        $this->db->or_like('order', $key, 'both');
        $this->db->or_like('created_at', $key, 'both');
        $this->db->or_like('updated_at', $key, 'both');

        $this->db->order_by('id', 'desc');

        $this->db->limit($limit, $start);
        $data['website'] = $this->db->get('website')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }

        // pagination
        $config['base_url'] = site_url('admin/website/search');
        $this->db->reset_query();
        $this->db->like('id', $key, 'both');
        $this->db->or_like('url', $key, 'both');
        $this->db->or_like('basic_desc', $key, 'both');
        $this->db->or_like('category_id', $key, 'both');
        $this->db->or_like('contact_person', $key, 'both');
        $this->db->or_like('Mobile', $key, 'both');
        $this->db->or_like('Mobile_2', $key, 'both');
        $this->db->or_like('email', $key, 'both');
        $this->db->or_like('facebook', $key, 'both');
        $this->db->or_like('rating', $key, 'both');
        $this->db->or_like('auto_featch', $key, 'both');
        $this->db->or_like('file_image', $key, 'both');
        $this->db->or_like('active', $key, 'both');
        $this->db->or_like('admin_notes', $key, 'both');
        $this->db->or_like('order', $key, 'both');
        $this->db->or_like('created_at', $key, 'both');
        $this->db->or_like('updated_at', $key, 'both');

        $config['total_rows'] = $this->db->from("website")->count_all_results();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        $config['per_page'] = 10;
        // Bootstrap 4 Pagination fix
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();

        $data['key'] = $key;
        $data['_view'] = 'admin/website/index';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Export website
     *
     * @param $export_type -
     *            CSV or PDF type
     */
    function export($export_type = 'CSV')
    {
        if ($export_type == 'CSV') {
            // file name
            $filename = 'website_' . date('Ymd') . '.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");
            // get data
            $this->db->order_by('id', 'desc');
            $websiteData = $this->Website_model->get_all_website();
            // file creation
            $file = fopen('php://output', 'w');
            $header = array(
                "Id",
                "Url",
                "Basic Desc",
                "Category Id",
                "Contact Person",
                "Mobile",
                "Mobile 2",
                "Email",
                "Facebook",
                "Rating",
                "Auto Featch",
                "File Image",
                "Active",
                "Admin Notes",
                "Order",
                "Created At",
                "Updated At"
            );
            fputcsv($file, $header);
            foreach ($websiteData as $key => $line) {
                fputcsv($file, $line);
            }
            fclose($file);
            exit();
        } else if ($export_type == 'Pdf') {
            $this->db->order_by('id', 'desc');
            $website = $this->db->get('website')->result_array();
            // get the HTML
            ob_start();
            include (APPPATH . 'views/admin/website/print_template.php');
            $html = ob_get_clean();
            include (APPPATH . "third_party/mpdf60/mpdf.php");
            $mpdf = new mPDF('', 'A4');
            // $mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);
            // $mpdf->mirrorMargins = true;
            $mpdf->SetDisplayMode('fullpage');
            // ==============================================================
            $mpdf->autoScriptToLang = true;
            $mpdf->baseScript = 1; // Use values in classes/ucdn.php 1 = LATIN
            $mpdf->autoVietnamese = true;
            $mpdf->autoArabic = true;
            $mpdf->autoLangToFont = true;
            $mpdf->setAutoBottomMargin = 'stretch';
            $stylesheet = file_get_contents(APPPATH . "third_party/mpdf60/lang2fonts.css");
            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->WriteHTML($html);
            // $mpdf->AddPage();
            $mpdf->Output($filePath);
            $mpdf->Output();
            // $mpdf->Output( $filePath,'S');
            exit();
        }
    }
}
//End of Website controller