<div class="page-content-wrapper">
    <div class="page-content">
        <div class="row" id="sortable_portlets">

            <div class="col-md-12">
                <div class="portlet box blue-hoki portlet-sortable">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-puzzle font-white"></i>
                            <span class="caption-subject bold font-white">  咨询详细信息 </span>
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body bg-grey">
                      <div class="row">

                        <div class="col-md-4">

                          <h2><strong><?=$contact_info->contact_type = 1 ? '远程会诊' : '远程门诊'?></strong></h2>

                            <p class="under-line">

                            </p>
                          </center>
                        </div>
                        <div class="col-md-8">

                        <h2><strong>咨询详情</strong></h2>
                            <p class="under-line">

                            </p>

                        </div>
                      </div>

                        <div class="row ">
                            <div class="col-md-4 left-line">
                                <div class="mt-element-ribbon">
                                    <div class="row" style="padding-top: 5%;">
                                        <div class="form-group form-md-line-input col-md-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <button class="btn contact-button"  type="button">附件上传 </button>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" class="form-control" value="<?=$contact_info->check_result_doc?>">
                                                </div>
                                                <span class="input-group-btn btn-right">
                                                        <button class="btn contact-button" type="button">预览</button>
                                                    </span>
                                            </div>

                                        </div>
                                        <div class="form-group form-md-line-input col-md-offset-1">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <button class="btn contact-button" type="button">影像上传 </button>
                                                    </span>
                                                <div class="input-group-control">
                                                    <input type="text" disabled class="form-control" value="<?=$contact_info->checkup_image_upload?>">
                                                </div>
                                                <span class="input-group-btn btn-right">
                                                        <button class="btn contact-button" type="button">预览</button>
                                                    </span>
                                            </div>

                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                        <label class="contact-text">申请医生：</label>
                                                    </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=get_user_name_by_id($contact_info->doctor_name)?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                  <label class="contact-text">申请医院：</label>
                                                </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=$contact_info->req_hospital?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                  <label class="contact-text">申请时间：</label>
                                                    </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=$contact_info->submit_time?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                  <label class="contact-text">会诊专家：</label>
                                                    </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=$contact_info->set_hospital?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                  <label class="contact-text">协助部门：</label>
                                                    </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=$contact_info->set_class?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <div class="input-group">
                                                <span class="input-group-btn btn-left">
                                                  <label class="contact-text">会诊时间： </label>
                                                    </span>
                                                <div class="input-group-control">
                                                  <label class="contact-text"><?=$contact_info->set_check_time?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mt-element-ribbon bg-grey">
                                  <div class="row">
                                    <div class="form-group col-md-6 form-md-line-input">
                                        <div class="input-group">
                                            <span class="input-group-btn btn-left">
                                              <label class="contact-text">患者编号： </label>
                                                </span>
                                            <div class="input-group-control">
                                              <label class="contact-text text-unnder-line"><?=$contact_info->patient_code?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 form-md-line-input">
                                        <div class="input-group">
                                            <span class="input-group-btn btn-left">
                                              <label class="contact-text">身份证号 : </label>
                                                </span>
                                            <div class="input-group-control">
                                              <label class="contact-text text-unnder-line"><?=$contact_info->license_num?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 form-md-line-input">
                                        <div class="input-group">
                                            <span class="input-group-btn btn-left">
                                              <label class="contact-text">姓名： </label>
                                                </span>
                                            <div class="input-group-control">
                                              <label class="contact-text text-unnder-line"><?=$contact_info->patient_name?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 form-md-line-input">
                                        <div class="input-group">
                                            <span class="input-group-btn btn-left">
                                              <label class="contact-text">性别： </label>
                                                </span>
                                            <div class="input-group-control">
                                              <label class="contact-text text-unnder-line"><?=get_gender($contact_info->patient_gender)?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 form-md-line-input">
                                        <div class="input-group">
                                            <span class="input-group-btn btn-left">
                                              <label class="contact-text">年龄： </label>
                                                </span>
                                            <div class="input-group-control">
                                              <label class="contact-text text-unnder-line"><?=$contact_info->patient_age?></label>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                    <div class="row" style="padding-top: 5%;">

                                        <div class="form-group ">
                                            <label class="contact-text">病人描述</label>

                                            <textarea disabled class="form-control contact-text" value="" rows="6"><?=$contact_info->disease_summary?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="contact-text">病人描述</label>

                                            <textarea disabled class="form-control contact-text" value="" rows="6"><?=$contact_info->medical_history?></textarea>

                                        </div>
                                        <div class="form-group">
                                            <label class="contact-text">咨询问题</label>

                                            <textarea disabled class="form-control contact-text" value="" rows="6"><?=$contact_info->contact_problem?></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <center>
                                <button type="button" class="btn contact-button" onclick="window.history.go(-1)"><span class="glyphicon glyphicon-arrow-left"> </span>返回</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style media="screen">
    .contact-button {
        width: 80px;
        background-color: rgb(51, 153, 153);
        font-size: 14px;
        font-weight: 400;
        font-style: normal;
        text-decoration: none;
        font-family: 微软雅黑;
        color: rgb(255, 255, 255);
        padding: 0px;
        margin: 0px;
        word-break: break-word;
    }
    h2 {
      white-space: nowrap; text-align: center; font-size: 28px; font-weight: 700; font-style: normal; text-decoration: none; font-family: 微软雅黑; color: rgb(0, 153, 153);
    }
    .left-line {
      border-style: hidden solid hidden hidden;
      border-width: 5px;
      margin: 15px;
      border-color: #399999;
    }
    .contact-text {
      white-space: nowrap; text-align: left; font-size: 16px; font-weight: 700; font-style: normal; text-decoration: none; font-family: 微软雅黑; color: rgb(0, 153, 153);
    }

    .under-line {
      border-style: solid hidden hidden hidden;
      border-width: 5px;
      margin: 15px;
      border-color: #399999;
    }

    .text-unnder-line {
      border-style: hidden hidden solid hidden;
      border-width: 2px;
      margin-top:15px;
      border-color: #399999;
    }
    </style>
