<?php
    require_once dirname(dirname(dirname(__FILE__))) . '/common/app.php';
    if(!isset($_COOKIE['userId'])){
        header('Location: '.\App::getHome());
        exit();
    }
    $userId = $_COOKIE['userId'];
    $etatCompte = $_COOKIE['etatCompte'];
    $login = $_COOKIE['login'];
    $profil = $_COOKIE['profil'];
    $status = $_COOKIE['status'];
    $codeUsine = $_COOKIE['codeUsine'];
?>
<div class="page-content">
    <div class="page-header">
        <h1>
            Demoulage des produits
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Demoulage
            </small>
        </h1>
    </div><!-- /.page-header -->

     <div class="row">
            <div class="col-sm-5">
                
                <div class="widget-box transparent">
                    <div class="widget-header widget-header-flat">
                        <h4 class="widget-title lighter">
                            <i class="ace-icon fa fa-star orange"></i>
                            Liste des produits a demouler
                        </h4>

                        <div class="widget-toolbar">
                            <a href="#" data-action="collapse">
                                <i class="ace-icon fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="widget-body">
                        <div class="widget-main no-padding">
                          <table id="LIST_BONS" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center" style="border-right: 0px none;">
                                    <label>
                                        <input type="checkbox" value="*" name="allchecked"/>
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th class="center" style="border-left: 0px none;border-right: 0px none;"></th>                               
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Designation
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock Initial
                                </th>
                                <th style="border-left: 0px none;border-right: 0px none;">
                                    Stock Final
                                </th>

                                <!--<th class="hidden-phone" style="border-left: 0px none;border-right: 0px none;">
                                </th>-->
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                        </div><!-- /.widget-main -->
                    </div><!-- /.widget-body -->
                </div><!-- /.widget-box -->
            </div><!-- /.col -->
            <div class="col-sm-7">
                <div class="widget-container-span">
                    <div class="widget-box transparent">
                        <div class="widget-header">

                            <h4 class="lighter"></h4>
                            <div class="widget-toolbar no-border">
                                <ul class="nav nav-tabs" id="TAB_GROUP">

                                    <li id="TAB_INFO_VIEW" class="active">
                                        <a id="TAB_INFO_LINK" data-toggle="tab" href="#TAB_INFO">
                                            <i class="green icon-dashboard bigger-110"></i>
                                            Demoulage
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                     <form id="validation-form" class="form-horizontal"  onsubmit="return false;">
                        <div class="widget-body">
                            <div class="widget-main padding-12 no-padding-left no-padding-right">
                                <div class="tab-content padding-4">
                                 <h4 class="widget-title lighter">
                                 <i class="ace-icon fa fa-star orange"></i>Produit: Sole
                                 </h4>
                               <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Stock Intial (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="text"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" disabled >
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Stock Final (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Stock Final (kg)</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Nombre Kg / Carton</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" style="margin-top: 12px;"> Nombre Carton</label>
                                    <div class="col-sm-9">
                                        <input type="number"  id="telephone" placeholder="" class="col-xs-10 col-sm-4" style="margin-top: 12px;">
                                    </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div><!--/.span6-->
            </div>
        </div><!-- /.row -->