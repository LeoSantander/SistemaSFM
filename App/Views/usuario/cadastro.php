<?php
    //Se não existe Usuário na Sessão, redireciona para Login
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
        //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
    } else if (!($Sessao::retornaTPUsuario() == 'Administrador')){
        $this->redirect('home/');
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Usuário</h3>

            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>

            <?php } ?>
            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control" placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="usuario" class="form-control" name="usuario" placeholder="Ex.: Nome.sobrenome" value="<?php echo $Sessao::retornaValorFormulario('usuario'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" class="form-control" name="senha" placeholder="Senha para acessar ao sistema" value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>
                <div class="form-group">
                    <label for="tpusuario">Tipo Usuario:</label>
                    <select class="form-control" name= "tpusuario" value="<?php echo $Sessao::retornaValorFormulario('tpusuario'); ?>">
                        <option  name="tpusuario" value="Administrador">Administrador</option>
                        <option  name="tpusuario" value="Padrao">Padrão</option>
                    </select required> 
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>