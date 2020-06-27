<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

 <div class="card-block">
                            <h2 class="white">Login</h2>
                           <?= $this->Form->create('',['validate']) ?>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="email" class="form-control" name="email" id="inputEmail" class="text"  required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="password" class="form-control" name="password" id="inputPass"  value=""  required>
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-pink btn-block btn-raised">Submit</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
