<form id="pagerForm" method="post" action="<?php echo site_url('manage/list_pg_qq')?>">
    <input type="hidden" name="pageNum" value="<?php echo $pageNum;?>" />
    <input type="hidden" name="numPerPage" value="<?php echo $numPerPage;?>" />
    <input type="hidden" name="orderField" value="<?php echo $this->input->post('orderField');?>" />
    <input type="hidden" name="orderDirection" value="<?php echo $this->input->post('orderDirection');?>" />
</form>

<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <?php if($this->session->userdata('permission_id') == 1 || in_array(11,$this->session->userdata('position_id_array'))): ?>
                <li><a class="add" href="<?php echo site_url('manage/add_pg_qq')?>" target="dialog" rel="add_pg_qq" title="新建"><span>新建</span></a></li>
                <li><a class="delete" href="<?php echo site_url('manage/delete_pg_qq')?>/{id}" target="ajaxTodo"  title="确定要删除？" warn="请选择一条记录"><span>删除</span></a></li>
                <li><a class="edit" href="<?php echo site_url('manage/edit_pg_qq/{id}')?>" target="dialog" rel="edit_pg_qq" warn="请选择一条记录" title="查看"><span>查看</span></a></li>
            <?php endif ?>
        </ul>
    </div>

    <div layoutH="54" id="list_warehouse_in_print">
        <table class="list" width="100%" targetType="navTab" asc="asc" desc="desc">
            <thead>
            <tr>
                <th width="30">ID</th>
                <th>QQ</th>
                <th>备注</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($res_list)):
                foreach ($res_list as $row):
                    ?>
                    <tr target="id" rel=<?php echo $row->id; ?>>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->qq;?></td>
                        <td><?php echo $row->desc;?></td>
                        <td><?php
                            if($row->flag == 1){
                                echo '使用';
                            }else{
                                echo '禁用';
                            } ?></td>
                    </tr>
                    <?php
                endforeach;
            endif;
            ?>
            </tbody>
        </table>
    </div>
    <div class="panelBar" >
        <div class="pages">
            <span>显示</span>
            <select name="numPerPage" class="combox" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20" <?php echo $this->input->post('numPerPage')==20?'selected':''?>>20</option>
                <option value="50" <?php echo  $this->input->post('numPerPage')==50?'selected':''?>>50</option>
                <option value="100" <?php echo $this->input->post('numPerPage')==100?'selected':''?>>100</option>
                <option value="200" <?php echo $this->input->post('numPerPage')==200?'selected':''?>>200</option>
            </select>
            <span>条，共<?php  echo $countPage;?>条</span>
        </div>
        <div class="pagination" targetType="navTab" totalCount="<?php echo $countPage;?>" numPerPage="<?php echo $numPerPage;?>" pageNumShown="10" currentPage="<?php echo $pageNum;?>"></div>
    </div>
</div>