<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ayarlar extends CI_Controller {

    public function __construct(){
         parent::__construct();

        $user = $this->session->userdata("user");

        if(!$user){
            redirect(base_url("admin"));
        }
    }
    
	public function index(){
        
        //Ayarları veritabanından getirme
        $genel_ayarlar = $this->ayarlar_model->get_all();
        
        //2 Adet data gönderme
        $data = array(
        'genel_ayarlar' => $genel_ayarlar,
        'title' => "Genel Ayarlar | Admin Paneli",
        );
        $this->load->view("admin/ayarlar", $data);
	}

    
    public function update(){

            $data = array(
            "site_title" => $this->input->post("site_title"),
            "site_description" => $this->input->post("site_description"),
            "site_keywords" => $this->input->post("site_keywords"),
            "anasayfa_film_sayisi" => $this->input->post("anasayfa_film_sayisi"),
            "anasayfa_kategori_sayisi" => $this->input->post("anasayfa_kategori_sayisi"),
            "anasayfa_etiket_sayisi" => $this->input->post("anasayfa_etiket_sayisi"),
            "arama_film_sayisi" => $this->input->post("arama_film_sayisi"),
            "enckizlenen_film_sayisi" => $this->input->post("enckizlenen_film_sayisi"),
            "site_facebook" => $this->input->post("site_facebook"),
            "site_twitter" => $this->input->post("site_twitter"),
            "site_instagram" => $this->input->post("site_instagram"),
            "site_youtube" => $this->input->post("site_youtube"),
            "site_google_plus" => $this->input->post("site_google_plus"),
            "site_tmdb_api" => $this->input->post("site_tmdb_api"),
            "guncelleyen_id" => $this->input->post("guncelleyen_id"),
            "updatedAt" => date("Y-m-d H:i:s")
            );
        
        $update = $this->ayarlar_model->update($data);
        
        if($update){
            
            $alert = array(
                "title" => "İşlem Başarılıdır",
                "text" => "Güncelleme işlemi başarılıdır...",
                "type" => "success"
            );
        }
        else{
            $alert = array(
                "title" => "İşlem Başarısızdır!!",
                "text" => "Güncelleme işlemi başarısızdır...",
                "type" => "error"
            );
        }
        
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("admin/ayarlar"));
    }
        

}