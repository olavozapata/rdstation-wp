# RD Station WP

## Integre seus formulários de contato do WordPress com o RD Station

O RD Station WP é um plugin para WordPress, que realiza a integração de seus formulários com o RD Station. Com ele você pode integrar qualquer formulário do seu site ou blog e ter controle sobre esses formulários integrados.

### Compatibilidade

O RD Station WP atualmente é compatível com os seguintes plugins:

* [Contact Form 7](#contact-form-7)
* [Gravity Forms](#gravity-forms)

### Instalação

Antes de tudo, baixe o plugin [clicando aqui](https://github.com/ResultadosDigitais/rdstation-wp/archive/master.zip).
  
Para instalá-lo no seu site, você precisa entrar no seu painel do WordPress, clicar em **Plugins**, **Adicionar novo** e depois em **Fazer upload do plugin**. Então selecione o arquivo que você baixou e clique em **Instalar agora**. Se o plugin foi instalado com sucesso, clique em **Ativar plugin**.

### Configuração

Depois de instalar o plugin, irá aparecer um item no seu menu WordPress, de acordo com o plugin de formulários que você tem ativo e instalado no seu formulário. Se você tem o Contact Form 7, irá aparecer **RD Station CF7**, já se você tiver o Gravity Forms, irá aparecer **RD Station GF**.
Se você tiver os dois formulários instalados, ambos estarão ativos no seu menu, e você pode usar os dois formulários simultaneamente sem problemas.

#### Contact Form 7

A integração no Contact Form 7 só irá funcionar com formulários que possuem um campo chamado **email** ou **your-email**

Para fazer uma integração, clique no item **RD Station CF7** que apareceu no menu do seu painel. Para criar uma nova integração, basta clicar em **Criar integração** e preencher os dados solicitados no formulário, como na imagem abaixo.

![Contact Form 7 Screenshot](images/cf7.png "cf7_screenshot")
*Clique na imagem para ampliar*


Crie um título para sua integração, apenas para organizar suas integrações e encontrá-la posteriormente no seu painel.

No campo **Identificador**, crie um Identificador para seu formulário. Isso é importante para você saber qual o formulário de origem do *lead*.  
Preencha o campo **Token RD Station** com o seu **Token Público** do RD Station. Este token, você pode encontrar em: http://rdstation.com.br/integracoes  
Por último, selecione qual formulário você deseja integrar. Este campo traz uma lista com todos os formulários criados no Contact Form 7.  

Clique em **Publicar**. Pronto, seu formulário escolhido está integrado ao RD Station.


#### Gravity Forms

Para a integração com o Gravity Forms funcionar, você precisa ter pelo menos um campo do tipo **e-mail** no seu formulário.  
Veja como criar campos do tipo e-mail no Gravity Forms na [Central de Ajuda do RD Station](http://ajuda.rdstation.com.br/hc/pt-br/articles/205542309)

Para fazer uma integração, clique no item **RD Station GF** que apareceu no menu do seu painel. Após isso o processo para criar uma nova integração é o mesmo do Contact Form 7: clique em **Criar integração** e preencha os dados solicitados no formulário, como na imagem abaixo.

![Gravity Form Screenshot](images/gf.png "gf_screenshot")
*Clique na imagem para ampliar*

Siga os mesmos passos usados no [Contact Form 7](#contact-form-7)

Clique em **Publicar**. Pronto, seu formulário escolhido está integrado ao RD Station.

### Novas funcionalidades
Você pode integrar um único formulário com mais de uma conta no RD Station, criando duas integrações com tokens diferentes. Isso pode ser útil quando você criar alguma campanha com um parceiro, e precisa gerar o lead para as duas contas.
