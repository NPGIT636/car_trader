<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        
       
       <li><?= $this->Html->link(__('Car Lists'), ['controller' => 'CarLists', 'action' => 'index']) ?></li>
       
		<?php if($this->request->session()->read('Auth.User.user_type')==1){?>
		 <li><?= $this->Html->link(__('Your Car list'), ['controller' => 'CarLists', 'action' => 'list']) ?></li>
        <li><?= $this->Html->link(__('Add New Car'), ['controller' => 'CarLists', 'action' => 'add']) ?></li>
		 <li><?= $this->Html->link(__('Sell List'), ['controller' => 'Carts', 'action' => 'selllist']) ?></li>
		<?php }?>
		 <?php if ($this->request->session()->read('Auth.User.id')){ ?>
		<li><?= $this->Html->link(__('My order'), ['controller' => 'Carts','action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
		<?php }else{ ?>
		
		 <li><?= $this->Html->link(__('Registration'), ['controller' => 'Users', 'action' => 'add']) ?></li>
		  <li><?= $this->Html->link(__('Login'), ['controller' => 'Users', 'action' => 'index']) ?></li>
		
		<?php }?>
    </ul>
</nav>