<?php

namespace App\Model;

class ResponseRequest
{
   private $code;

   private $message;

   private $content;

   public function __construct($code, $message)
   {
        $this->code = $code;

        $this->message = $message;
   }

   /**
    * Get the value of code
    */ 
   public function getCode()
   {
      return $this->code;
   }

   /**
    * Set the value of code
    *
    * @return  self
    */ 
   public function setCode($code)
   {
      $this->code = $code;

      return $this;
   }

   /**
    * Get the value of message
    */ 
   public function getMessage()
   {
      return $this->message;
   }

   /**
    * Set the value of message
    *
    * @return  self
    */ 
   public function setMessage($message)
   {
      $this->message = $message;

      return $this;
   }

   /**
    * Get the value of content
    */ 
   public function getContent()
   {
      return $this->content;
   }

   /**
    * Set the value of content
    *
    * @return  self
    */ 
   public function setContent($content)
   {
      $this->content = $content;

      return $this;
   }
}
