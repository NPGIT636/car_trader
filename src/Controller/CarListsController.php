<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CarLists Controller
 *
 * @property \App\Model\Table\CarListsTable $CarLists
 *
 * @method \App\Model\Entity\CarList[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarListsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
	   public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
		$search=[];
		$this->set('placeholder',['Search by  Seller Name , Car Name']);
		if(isset($this->request->query['search'])){  
				$keyword= trim($this->request->query['search']);
				$search[]=['OR'=>['Users.name LIKE' => "%$keyword%",'CarLists.name LIKE' => "%$keyword%"]];
				$this->request->data['search']=$this->request->query['search'];
				$this->set('search',$this->request->query['search']);
				}
        $carLists = $this->paginate($this->CarLists->find()->where(['is_sold'=>0,$search]));

        $this->set(compact('carLists'));
    }
	 public function list()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $carLists = $this->paginate($this->CarLists->find()->where(['user_id'=>$this->Auth->user('id')]));

        $this->set(compact('carLists'));
    }

    /**
     * View method
     *
     * @param string|null $id Car List id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carList = $this->CarLists->get($id, [
            'contain' => ['Users', 'Carts'],
        ]);

        $this->set('carList', $carList);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $carList = $this->CarLists->newEntity();
        if ($this->request->is('post')) {
            $carList = $this->CarLists->patchEntity($carList, $this->request->getData());
			$carList->user_id=$this->Auth->user('id');
            if ($this->CarLists->save($carList)) {
				
                $this->Flash->success(__('The car list has been saved.'));

                return $this->redirect(['action' => 'list']);
            }
            $this->Flash->error(__('The car list could not be saved. Please, try again.'));
        }
        $users = $this->CarLists->Users->find('list', ['limit' => 200]);
        $this->set(compact('carList', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Car List id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $carList = $this->CarLists->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carList = $this->CarLists->patchEntity($carList, $this->request->getData());
            if ($this->CarLists->save($carList)) {
                $this->Flash->success(__('The car list has been saved.'));

                return $this->redirect(['action' => 'list']);
            }
            $this->Flash->error(__('The car list could not be saved. Please, try again.'));
        }
        $users = $this->CarLists->Users->find('list', ['limit' => 200]);
        $this->set(compact('carList', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Car List id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $carList = $this->CarLists->get($id);
        if ($this->CarLists->delete($carList)) {
            $this->Flash->success(__('The car list has been deleted.'));
        } else {
            $this->Flash->error(__('The car list could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
