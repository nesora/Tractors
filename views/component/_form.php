<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Component */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="component-form">
    <div class="col-lg-5">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Enter component name']) ?>

        <?= $form->field($model, 'instock')->textInput(['maxlength' => true, 'placeholder' => 'Enter inventory amount']) ?>


        <?=
        $form->field($model, 'tractormodel_id')->dropDownList(
                $tractorModels, ['prompt' => ' - Select  Tractor Model - '])->label('Tractor Model')
        ?>

        <h1>  Dependancies </h1>

        <div class="table-responsive">   
            <div   class="input_fields_wrap">

                <?php if (isset($depModels)) : ?> 

                    <?php foreach ($depModels as $model) : ?>

                        <div class="col-md-12 ">

                            <div class="col-md-6 ">
                                <input type="hidden" class="deleteMe" name="ids[<?= $model->id ?>][dependentId]" value="<?= $model->id ?>" />
                                <select name="ids[<?= $model->id ?>][id]" class="form-control">

                                    <?php foreach ($components as $component) : ?>
                                        <option value="<?= $component->id ?>" 
                                                <?= $model->dependent_id == $component->id ? 'selected' : '' ?>><?= $component->name ?></option>
                                            <?php endforeach; ?>
                                </select>
                            </div> 
                            <div class="col-md-4 ">
                                <input type="text" name="ids[<?= $model->id ?>][quantity] " value="<?= $model->count ?>" class="form-control" placeholder="Enter amount" required  >
                            </div>

                            <button class="btn btn-default remove_field " title="Click to delete dependencies"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>

                    <?php endforeach; ?>



                    <div class="col-md-12 prob">  
                        <div class="col-md-3"> </div>
                        <div class="btn btn-default add_field_button col-lg-5" title="Click to add Dependencies" > <b> Add Dependencies  </b> </div>


                    </div>




                <?php else : ?>

                    <div class="col-md-12 ">
                        <div class="col-md-6 ">
                            <b> Dependent Component</b>
                            <input type="hidden" class="deleteMe" name="ids[0][dependentId]" value="<?= $model->id ?>" />
                            <select name="ids[0][id]" class="form-control">
                                <option>- Select component -</option>
                                <?php foreach ($components as $component) : ?>
                                    <option value="<?= $component->id ?>"><?= $component->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4 ">
                            <b> Amount Needed:</b>
                            <input type="text" name="ids[0][quantity]" class="form-control" placeholder="Enter amount" required >
                        </div>
                        <div style="visibility: hidden"> b  </div>
                        <div class="btn btn-default add_field_button">
                            <span class="glyphicon glyphicon-plus" title="Click to delete dependencies" ></span></div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <div id="deletedIds" ></div>



        <br>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var max_fields = 50; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        add_button.click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                wrapper.append('<div class="col-md-12 ">\
                                    <div class="col-md-6">\
                                        <input type="hidden" class="deleteMe" name="ids[' + x + '][dependentId]" value="" />\
                                        <select name="ids[' + x + '][id]" class="form-control">\\n\
                                                    <option>- Select component -</option>\
                                                        <?php foreach ($components as $component) : ?>\
                                                        <option value="<?= $component->id ?>"><?= $component->name ?></option>\
                                                        <?php endforeach; ?>\
                                        </select>\
                                    </div>\
                                    <div class="col-md-4 ">\
                                        <input type="text" name="ids[' + x + '][quantity]" class="form-control" placeholder="Enter amount" required>\
                                    </div>\
                                    <button class="btn btn-default  remove_field " title="Click to delete dependencies">\n\
                                    <span class="glyphicon glyphicon-trash" ></span></button>\
                                </div>'
                        );
            }
        });


        wrapper.on("click", ".remove_field", function (e) {
            var clickedId = $(this).parent().find('input[class="deleteMe"]').val();

            var deletedIdsArray = $('#deletedIDs');
            console.log($('#deletedIDs'));
            if (clickedId) {
                $('#deletedIds').append('<input type="hidden" name="deletedIds[]" value="' + clickedId + '">');
            }
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });

</script>