<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Instrument $instrument
 */
$this->extend('/layout/instrument'); 
?>

<div class="container">
    <h2 class="text-center mb-4">COMPETENCIA EMPRENDEDORA</h2>
    <div class="row">
        <div class="col col-md-6 offset-md-3">

            <p>Por favor ingrese los datos solicitados a continuación:</p>
            <?php 
                echo $this->Form->create(null,['method'=>'post','autocomplete'=>'off','id'=>'externo-form']);
                echo $this->Form->control('names', ['type' => 'text','label'=>'Nombres','required' => true]);
                echo $this->Form->control('lastnames', ['type' => 'text','label'=>'Apellidos','required' => true]);
                echo $this->Form->control('email', ['type' => 'email','label'=>'Correo electrónico','required' => true]);
                echo $this->Form->control('code', ['type' => 'text','label'=>'Código de validación *','required' => true]);
                //clave de sitio: 6LfLTqYaAAAAAEmwujbfWves-syqV_tSx6RdMYQp
                //clave secreta: 6LfLTqYaAAAAADcGdRHxqZw1ML9cx3Id_IfBLMVr
                // echo '<button class="g-recaptcha btn btn-primary">Ingresar</button>';
                echo $this->Form->button(__('Ingresar', ['type' => 'button']), [
                    'class' => 'btn btn-primary g-recaptcha', 
                    'data-sitekey' => "6LfLTqYaAAAAAEmwujbfWves-syqV_tSx6RdMYQp" ,
                    'data-callback' => "onSubmit",
                    'data-action' => "submit",
                ]);
                echo $this->Form->end(); 
            ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col">
            <small><b>*</b> El código de validación le fue suministrado por la organización para la cual está realizando este test. En caso que no lo posea, debe solicitárselos.  </small>
        </div>
    </div>
</div>

<?php $this->append('script') ?>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
        let form = $("#externo-form");
        let names = $("#names");
        let lastnames = $("#lastnames");
        let email = $("#email");
        let code = $("#code");
        $(".invalid-feedback").remove();
        let error = false;
        if(names.val() == ''){
            error = true;
            names.parent().addClass('has-validation');
            names.after('<div class="invalid-feedback">Por favor indique sus nombres.</div>')
        }
        if(lastnames.val() == ''){
            error = true;
            lastnames.parent().addClass('has-validation');
            lastnames.after('<div class="invalid-feedback">Por favor indique sus apellidos.</div>')
        }
        if(email.val() == ''){
            error = true;
            email.parent().addClass('has-validation');
            email.after('<div class="invalid-feedback">Por favor indique un correo electrónico válido.</div>')
        }
        if(code.val() == ''){
            error = true;
            code.parent().addClass('has-validation');
            code.after('<div class="invalid-feedback">Por favor indique el código.</div>')
        }
        if(!error){
            document.getElementById("externo-form").submit();
        }else{
            form.addClass('was-validated');
        }
    }
 </script>
<?php $this->end() ?>
