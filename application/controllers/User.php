<?php
class User extends CI_Controller{
    function __construct()
{
    parent :: __construct();
    $this->load->model('Post_model');
    $this->load->library('session');

}
    public function index($slug=NULL){        
    }

    public function posts($ofset= 0){
        $this->load->database();
        $config['base_url'] = 'http://localhost/post/user/posts';
        /*$config['per_page'] = 5;
        $config['total_rows'] = $this->Post_model->num_rows();*/
        $config['total_rows'] = 10;
        $config['per_page'] = 5;
        $this->pagination->initialize($config); 

        $data['posts'] = $this->Post_model->get_posts($config['per_page'], $config['total_rows'] );
        /*echo '<pre>';
        print_r($data['posts']);*/
        $this->load->view('index',$data);
    }
     
    public function views($slug = NULL){
          $slug = $this->input->post('slug');  
          $data['post'] = $this->Post_model->get_posts($slug);     
          //$data['posts'] = $this->Post_model->show_data($slug);
            //echo '<pre>'; print_r($data['posts']);
             $this->load->view('views', $data);
        }
        

        public function create(){
           $this->load->view('create_post');
           if(isset($_POST['submit'])){
            $slug = url_title($this->input->post('title'));
            $tite =  $this->input->post('title');
           $body =  $this->input->post('body');
           $Result = $this->Post_model->post_create($tite,$body,$slug);
            if($Result){
                $this->session->set_flashdata('post_created', 'Your post has been created!.');
                redirect('User/posts');
            }
           }
        }


        public function delete($id){
          $Res = $this->Post_model->delete_post($id); 
            if($Res){
            //$this->session->set_flashdata('post_delete', 'are you sure you want to delete this Post!.'); 
            redirect('User/posts');
          }
         }


         public function edit($id){
          //echo $id;
           // $this->load->view('edit');
              $data['posts'] = $this->Post_model->edit($id);
              //print_r($data['posts']);
             $this->load->view('edit',$data);

             $this->Post_model->update_post($id);
           }

        public function pagination(){
              $config['base_url'] = 'http://localhost/post/user/posts';
              $config['total_rows'] = 4;
              $config['per_page'] = 2;

              $this->pagination->initialize($config);

              echo $this->pagination->create_links();
              }


}



?>