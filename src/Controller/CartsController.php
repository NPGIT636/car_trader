<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Carts Controller
 *
 * @property \App\Model\Table\CartsTable $Carts
 *
 * @method \App\Model\Entity\Cart[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CartsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'CarLists'],
        ];
        $carts = $this->paginate($this->Carts->find()->where(['Carts.user_id'=>$this->Auth->user('id')]));

        $this->set(compact('carts'));
    }
	 public function selllist()
    {
        $this->paginate = [
            'contain' => ['Users', 'CarLists'],
        ];
        $carts = $this->paginate($this->Carts->find()->where(['Carts.seller_id'=>$this->Auth->user('id')]));

        $this->set(compact('carts'));
    }

    /**
     * View method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => ['Users', 'CarLists'],
        ]);

        $this->set('cart', $cart);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		if(!$id){
			return $this->redirect(['controller'=>'CarLists','action' => 'index']);
		}
		$car=$this->Carts->CarLists->get($id);
        $cart = $this->Carts->newEntity();
        
            $cart->user_id=$this->Auth->user('id'); 
			 $cart->car_list_id=$id;
			 $cart->price=$car->car_price;
			  $cart->tax=($car->car_price)*18/100;
			 $cart->seller_id=$car->user_id;
			 $cart->created_at=date('Y-m-d H:i:s');
			 
            if ($this->Carts->save($cart)) {
				$car->is_sold=1;
				$this->Carts->CarLists->save($car);
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }else{
				
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
			return $this->redirect(['controller'=>'CarLists','action' => 'index']);
			}
     
       // $this->set(compact('cart', 'users', 'carLists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cart = $this->Carts->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cart = $this->Carts->patchEntity($cart, $this->request->getData());
            if ($this->Carts->save($cart)) {
                $this->Flash->success(__('The cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The cart could not be saved. Please, try again.'));
        }
        $users = $this->Carts->Users->find('list', ['limit' => 200]);
        $carLists = $this->Carts->CarLists->find('list', ['limit' => 200]);
        $this->set(compact('cart', 'users', 'carLists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Cart id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cart = $this->Carts->get($id);
        if ($this->Carts->delete($cart)) {
            $this->Flash->success(__('The cart has been deleted.'));
        } else {
            $this->Flash->error(__('The cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
