<?php
namespace Admin\Controller;
/**
 * 角色控制器
 */
class RoleController extends BaseController{

    /**
     * 角色列表
     * @return [type] [description]
     */
	public function lst(){
        $role = D('Role');
        $data = $role->search(); // 查找所有角色名称
        dump($data);
        $this->assign(array(
            'data' => $data,
        ));
		$this->display();
	}

    /**
     * 添加角色
     */
	public function add(){
        if(IS_POST){
            $role = D('Role');
            if($role->addRole(I('post.'))){
                $this->success('添加成功！', U('lst?p='.I('get.p')));
            }else{
                $this->error($role->getError());
            }
            return;
        }
        $auth=D('Auth');
        $data=$auth->getTree(); // 获取权限列表
        $this->assign('data',$data);
		$this->display();
	}

    /**
     * 编辑角色
     */
	public function edit(){
        $id = I('get.id');
        if(IS_POST){
            $model = D('Role');
            if($model->create(I('post.'), 2)){
                if($model->save() !== FALSE){
                    $this->success('修改成功！', U('lst', array('p'=>I('get.p', 1))));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $model = M('Role');
        $data = $model->find($id);
        $this->assign('data', $data);
		$this->display();
	}

    /**
     * 删除角色
     * @return [type] [description]
     */
    public function delete(){
        $model = D('Role');
        if($model->delete(I('get.id', 0)) !== FALSE){
            $this->success('删除成功！', U('lst', array('p'=>I('get.p', 1))));
            exit;
        } else {
            $this->error($this->getError());
        }
    }


}