<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Local de Trabalho</h3>
            <hr>
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php } ?>
            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $Sessao::retornaSucesso(); ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/localTrabalho/salvar" method="post">
            <div class="form-group">
            
            <div class="form-group">
                    <label for="nome">Sigla Local(Opcional): </label>
                    <input type="text" class="form-control"  name="sglocal" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('sglocal'); ?>"> 
            </div>
            <div class="form-group">
                    <label for="nome">Nome Fantasia:</label>
                    <input type="text" class="form-control"  name="fantasia" placeholder="Auto Posto Marilia" value="<?php echo $Sessao::retornaValorFormulario('fantasia'); ?>" 
                           title="Este campo não pode estar vazio." required autofocus> 
            </div>
            </div>
            <div class="form-group">
                    <label for="nome">CNPJ:</label>
                    <input type="text"  maxlength="18"  class="form-control"  name="cnpj" placeholder=" " 
                        value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>" 
                        oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" 
                        onkeydown="javascript: fMasc( this, mCNPJ );"> 
            </div>
            
            <h5>Endereço:</h5>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="nome">Rua:</label>
                    <input type="text" class="form-control"  name="rua" placeholder=" Rua Nove de Julho" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
                        title="Use somente letras. Não use caracteres especiais ou números." required autofocus> 
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero:</label>
                    <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" value="<?php echo $Sessao::retornaValorFormulario('numero'); ?>" 
                        pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="nome">Bairro:</label>
                    <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
                           title="Use somente letras. Não use caracteres especiais ou números." required autofocus> 
                </div>
                <div class="form-group col-md-3">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000" value="<?php echo $Sessao::retornaValorFormulario('cep'); ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                           title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" required autofocus> 
                    </div>
            </div>
            <div class="form-group">        
                <label for="cidade">Cidade:</label>
	                <select name= "cidade" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>" required>
                                <option name="cidade" value="">Selecione uma Cidade</option>            
                                <?php foreach($viewVar['listarCidades'] as $cidade){?>
	                                <option  name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                                <?php } ?>
                        </select> 
                </div>
            <br>
            <h5>Contato:</h5>
            <hr>
            <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(14) 3300-3000" 
                        value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                        title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus> 
            </div>

            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" placeholder="nome@dominio.com" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@dominio.com" required autofocus> 
            </div>
            <hr>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>

            </div> 
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
