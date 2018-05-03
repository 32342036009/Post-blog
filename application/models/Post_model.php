<?php 
    class Post_model extends CI_Model{
        
        public function get_posts(){
            $this->load->database();
             /*if($slug === FALSE){
                $query = $this->db->get('posts');
                return $query->result_array();                
            }

            $query = $this->db->get_where('posts', array('slug' => $slug));
            return $query->row_array();*/

            $query = $this->db
                             ->select('*')
                             ->from('posts')
                             ->get();
                        // $query = $this->db->query('SELECT * FROM posts');
                             //echo $this->db->last_query();
                            return $query->result_array();
       }

        public function post_create($title,$body,$slug){
            $data = array('title'=>$title,
                          'body'=>$body,
                          'slug'=>$slug );
            $res = $this->db->insert('posts' ,$data);     
           return $res;    
        }

            public function delete_post($id){
                $this->db->where('id', $id);
                $this->db->delete('posts');
                return true;
            }

            public function edit($id){
                $this->db->where('id', $id);
                $query = $this->db->get('posts');
                return $query->result_array(); 

            }


            public function show_data($slug){
                $this->db->get->where('slug', $slug);
                $query = $this->db->get('posts');
                //echo $slug;
                 //$query = $this->db->get('posts');
                 //echo $this->db->last_query();
                    return $query;
                //echo $this->db->last_query();
            }

            public function update_post($id){
                $slug = url_title($this->input->post('title'));
                $data = array(
                                'title' => $this->input->post('title'),
                                'slug'  => $slug,
                                'body'  => $this->input->post('body'));
                    $this->db->where('id', $id);
                    $this->db->update('posts', $data);
                    //echo $this->db->last_query();


            }

            public function num_rows($limit , $ofset ){
                 $query =   $this->db
                                 ->select('*')
                                 ->from('posts')
                                 ->limit($limit,$ofset)
                                 ->get();
                /*$query = $this->db->query("SELECT * FROM posts LIMIT '$limit' , '$ofset' ");*/
                          //echo $this->db->last_query();  
                            return $query->num_rows();

            }


            

    }


?>