<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EmailTemplate extends MY_Controller
{
	public $mLayout = 'marketing/';
	public $sub_mLayout = 'marketing/emailtemplate/';

	function __construct()
	{
		parent::__construct();
		$this->mHeader['id'] = 'package';
		$this->mHeader['title'] = 'Land Ads';
		$this->mContent['msg'] = "";
	}

	public function index()
	{
		$this->list();
	}

	public function list()
	{
		$this->mHeader['sub_id'] = 'view';
		$this->render("{$this->sub_mLayout}index", $this->mLayout);
	}


	public function get_data()
	{
		$this->db->select('*');
		$this->db->order_by('created_at', 'desc');
		$data = $this->db->get_where('mark_email_template', array())->result_array();

		foreach ($data as $k => $v) {

			$data[$k]['title'] = $v['title'];
			$data[$k]['status'] = $v['status'] ? 'Active' : 'Normal';
			$data[$k]['link'] = $v['status'] ? $v['link_active'] : $v['link_normal'];
			if ($v['photo']) {
				$data[$k]['photo'] = '<img src="' . base_url() . $v['photo'] . '" width="100" height="100"/>';
			}
		}

		$table_data['data'] = $data;

		echo json_encode($table_data);
	}

	public function add()
	{

		$this->mHeader['sub_id'] = 'add';
		$this->mContent['data'][0]['id'] = '0';
		$this->render("{$this->sub_mLayout}add", $this->mLayout);
	}

	public function save_article()
	{
		$article_id = $this->input->post('article_id');
		$template_name = $this->input->post('template_name');
		$subject = $this->input->post('subject');
		$content = $this->input->post('content');
		$status = $this->input->post('status');
		$details = array();


		if ($article_id) {
			$old = $this->db->get_where('mark_email_template', array('id' => $article_id))->row_array();
			if ($old) {

				$data = array(
					'template_name' => $template_name,
					'subject' => $subject,
					'content' => $content,
					'status' => $status,
					'created_at' => date("Y-m-d H:i:s")
				);
				$this->db->update('mark_email_template', $data, array('id' => $article_id));
			}

		} else {

			$data = array(
				'template_name' => $template_name,
				'subject' => $subject,
				'content' => $content,
				'status' => $status,
				'created_at' => date("Y-m-d H:i:s")
			);
			$this->db->insert('mark_email_template', $data);
			$new_article_id = $this->db->insert_id();

		}

		echo json_encode($data);

	}


	public function preview()
	{
		$data = $this->input->post();
		$content = $data['content'];
		$email_content = replace_url($content);
		$email_content = process_email_image($email_content);

		$email_content = '<div>Hi, [User]</div>
<table width=\'100%\'><tr><td width=\'100%\' valign="top" style="padding-right: 20px;">' . $email_content . '</td>
</tr></table>';

		$preview_content = $this->load->view('email/template', array('email_content' => $email_content), true);

		echo json_encode(array('ok' => 1, 'preview' => $preview_content));

	}


	public function send_Email()
	{

		$input = $this->input->post();
		$id = $input['article_id'];
		$this->save_article();

		$template = $this->db->get_where('mark_email_template', array('id' => $id))->row_array();

		$email_content = $template['content'];
		$subject = $template['subject'];


		$sponsors = $this->db->get_where('mark_user', array('email <>' => ''))->result_array();

		foreach ($sponsors as $user) {
			$email = $user['email'];
			$image_refer = '<img alt="check" width="15" height="15" src="' . site_url('refered?e=' . $email . '&s=' . $subject . '&n=' . $user['name'] . '&t=' . $user['phone_number'] . '&type=' . $user['title'] . '&p=Email') . '"/>';
			$queue = array('email' => $email,
				'content' => '<div>Hi, ' . $user['name'] . '</div>
<table width=\'100%\'><tr><td width=\'100%\' valign="top">' . $email_content . '</td>
</tr></table>' . $image_refer,
				'subject' => $subject,
				'status' => 0,
				'type' => 'marketing',
				'created' => date("Y-m-d H:i:s"));
			$this->db->insert('tbl_email_queue', $queue);

		}
		$this->db->update('mark_email_template', array('total' => $template['total'] + count($sponsors), 'last_sent' => date("Y-m-d H:i:s")), array('id' => $id));
		cronEmail();
		echo json_encode(array('status' => 1, 'message' => 'Total emails:  ' . count($sponsors) . ' sponsor\'s emails has added to queue.'));


	}

	public function send_EmailNow()
	{

		$input = $this->input->post();


		$id = $input['id'];
		$template = $this->db->get_where('mark_email_template', array('id' => $id))->row_array();
		$email_content = $template['content'];
		$subject = $template['subject'];

		$sponsors = $this->db->get_where('mark_user', array('email <>' => ''))->result_array();

		foreach ($sponsors as $user) {
			$email = $user['email'];
			$image_refer = '<img alt="check" width="15" height="15" src="' . site_url('refered?e=' . $email . '&s=' . $subject . '&n=' . $user['name'] . '&t=' . $user['phone_number'] . '&type=' . $user['title'] . '&p=Email') . '"/>';
			$queue = array('email' => $email,
				'content' => '<div>Hi, ' . $user['name'] . '</div>
<table width=\'100%\'><tr><td width=\'100%\' valign="top">' . $email_content . '</td>
</tr></table>' . $image_refer,
				'subject' => $subject,
				'status' => 0,
				'type' => 'marketing',
				'created' => date("Y-m-d H:i:s"));
			$this->db->insert('tbl_email_queue', $queue);

		}

		$this->db->update('mark_email_template', array('total' => $template['total'] + count($sponsors), 'last_sent' => date("Y-m-d H:i:s")), array('id' => $id));
		cronEmail();

		echo json_encode(array('status' => 1, 'message' => 'Total emails:  ' . count($sponsors) . ' sponsor\'s emails has added to queue.'));


	}

	public function send_test()
	{

		$input = $this->input->post();


		$email_content = $input['content'];
		$send_type = $input['send_type'];
		$email_content = replace_url($email_content);
		$email_content = process_email_image($email_content);

		$subject = $input['subject'];

		$test_email = $input['test_email'];

		//send email to sponsor
		$sponsors = $this->db->get_where('mark_user', array('email <>' => ''))->result_array();
		$toEmail = $test_email;
		$content = 'Hi, ' . $user['name'] . "<br/>" . $email_content . $image_refer;

		if ($send_type == 'smtp') {
			$send = sendMail($subject, $toEmail, $content);
		} else {
			$send = sendMailFunction($subject, $toEmail, $content);
		}

		/*foreach($sponsors as $user) {
				  $email = $test_email;

				  $image_refer = '<img alt="check" width="15" height="15" src="'.site_url('refered?e='.$email.'&s='.$subject.'&n='.$user['name'].'&t='.$user['phone_number'].'&type='.$user['title'].'&p=Email').'"/>';
				  $queue = array('email'=>$email,
					  'content'=>'Hi, '.$user['name']. "<br/>".$email_content.$image_refer,
					  'subject'=>$subject,'status'=>0,'created'=>date("Y-m-d H:i:s"));
				  $this->db->insert('tbl_email_queue',$queue);
				  break;

			  }*/
		//cronEmail();
		echo json_encode(array('status' => $send, 'message' => ($send) ? 'The emails has been sent.' : 'Sorry, cannot send email now, Please try again later'));


	}


	public function edit()
	{

		$this->mHeader['sub_id'] = 'view';
		$id = $this->input->get('id');
		$this->mContent['data'] = $this->db->get_where('mark_email_template', array('id' => $id))->row_array();
		$this->render("{$this->sub_mLayout}edit", $this->mLayout);
	}


	public function delete()
	{
		$id = $this->input->post('id');
		$this->db->delete('mark_email_template', array('id' => $id));
	}

}
