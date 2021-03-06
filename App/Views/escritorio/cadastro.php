<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Escritório</h3>
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

            <form action="http://<?php echo APP_HOST; ?>/escritorio/salvar" method="post">

            <div class="form-row">
                  <div class="form-group col-md-8">
                          <label for="escritorio">Nome do Escritório:</label>
                          <input type="text" class="form-control"  name="escritorio" value="<?php echo $Sessao::retornaValorFormulario('escritorio'); ?>"
                                 title="Este campo não pode estar vazio." required autofocus>
                  </div>
                  <div class="form-group col-md-4">
                          <label for="nome">CNPJ:</label>
                          <input type="text"  maxlength="18"  class="form-control"  name="cnpj" placeholder=" "
                              value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>"
                              oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}"
                              onkeydown="javascript: fMasc( this, mCNPJ );">
                  </div>
              </div>

              <br>
              <h5>Endereço:</h5>
              <hr>
              <div class="form-row">
                  <div class="form-group col-md-10">
                      <label for="nome">Rua:</label>
                      <input type="text" class="form-control"  name="rua" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" pattern="[A-Za-zÀ-ú0-9 ]{0,}"
                          title="Use somente letras ou números. Não use caracteres especiais." autofocus>
                  </div>
                  <div class="form-group col-md-2">
                      <label for="endereco">Número:</label>
                      <input type="text" class="form-control" maxlength="5" name="endereco" placeholder="000" value="<?php echo $Sessao::retornaValorFormulario('endereco'); ?>"
                          pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" autofocus>
                  </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-9">
                      <label for="nome">Bairro:</label>
                      <input type="text" class="form-control" name="bairro" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                             title="Use somente letras. Não use caracteres especiais ou números." autofocus>
                  </div>
                  <div class="form-group col-md-3">
                          <label for="cep">CEP:</label>
                          <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000" value="<?php echo $Sessao::retornaValorFormulario('cep'); ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                             title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" autofocus>
                      </div>
              </div>
              <label for="cidade">Cidade:</label>
              <div class="form-row">
                  <div class="form-group col-md-8">

  	                    <select name= "cidade" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>">
                              <option name="cidade" value="">Selecione uma Cidade</option>
                              <?php foreach($viewVar['listarCidades'] as $cidade){?>
  	                            <option  name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                              <?php } ?>
                          </select>
                  </div>
                  <div class="form-group col-md-4">

                      <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-placement="bottom" data-target="#myModal" aria-hidden="true">+ Nova Cidade</a>
                  </div>
              </div>
              <br>
              <h5>Contato:</h5>
              <hr>

              <div class="form-row">
              <div class="form-group col-md-4">
                      <label for="telefone">Telefone:</label>
                      <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(xx) xxxx-xxxx"
                          value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                          title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" autofocus>
              </div>

              <div class="form-group col-md-8">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control"  name="email" placeholder="nome@dominio.com" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>"
                          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@dominio.com" autofocus>
              </div>
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

<?//modal de cidades?>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header bg-dark text-white">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar Nova Cidade</span></h5>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
  				<div class="modal-body">
  					<!--Montando o formulário-->
                      <form action="http://<?php echo APP_HOST; ?>/cidade/salvar" method="post">
                  <!-- Só um campo para validar na action e depois retornar na view -->
                  <input type="hidden" class="form-control"  name="id" placeholder="" value="ES">

                  <!--Campo Nome-->
                  <div class="form-group">
                      <label for="nome">Nome:</label>
                      <input type="text" class="form-control"  name="nome" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"
                             required pattern="[A-Za-zÀ-ú ]{0,}"
                             title="Não use caracteres especiais ou números">
                  </div>

                  <!--Campo Estado-->
              <div class="form-group">
  	        <label for="estado">Estado:</label>

  	        <!-- Inicie a ComboBox -->
  	        <select required class="form-control" name= "estado" value="">
                  <option name= "estado" value="">Selecione um Estado</option>

  		        <?php foreach($viewVar['listarEstados'] as $estados){?>
  	                <option  name="estado" value= "<?php echo $estados->ID_Estado;?>"><?php echo $estados->NM_Estado;?> - <?php echo $estados->CD_Estado;?></option>
                  <?php } ?>

              </select>
              </div>
  				</div>

  				<div class="modal-footer">
  				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Cancelar</button>
  					<button type="submit" class="btn btn-success">Salvar</button>
  				</div>
  			</div>
  		</div>
  	</div>
