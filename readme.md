# RD Station WP

## Integre o Contact Form 7 com o RD Station

O **RD Station WP** é um plugin para WordPress, que realiza a integração do seu formulário (Contact Form 7) com o RD Station.  
Seu uso é bastante simples, e consiste apenas em uma configuração adicional no seu WordPress, onde você preencherá seu **Token Público** do RD Station. Com isso você poderá integrar os formulários que quiser.  

### Requisitos
* Conta no RD Station
* Site/blog em WordPress
* Contact Form 7 instalado em seu site/blog

### Instalação
Os blogs entregues pela Resultados Digitais atualmente, já vem com o RD Station WP instalado. Se for o seu caso, pule esta etapa.  

Se seu site/blog atende os requisitos mencionados acima, baixe o plugin neste link: [http://rdstation.com.br/rdstation-wp.zip](http://rdstation.com.br/rdstation-wp.zip)

Com o plugin baixado, entre no seu painel do WordPress, e vá até a página de plugins. Depois clique em **Adicionar novo** e **Fazer upload do plugin**. Então selecione o arquivo que você baixou e clique em **Instalar agora**. Após a instalação, clique em **Ativar plugin**.  
Pronto, seu plugin foi instalado. Precisamos agora configurá-lo para realizar a integração com o RD Station.

### Configurando o plugin

Ainda no seu painel do WordPress, entre na página de configurações. Note que no final da página apareceu um campo chamado **Token RD Station**. Basta preencher seu **token público**.  

Seu token público pode ser encontrado aqui: [https://www.rdstation.com.br/integracoes](https://www.rdstation.com.br/integracoes)

### Criando o formulário

Seu formulário precisa de dois campos obrigatórios, para que a integração seja feita: o `email` e o `identificador`.
Se seu formulário não possuir esses dois campos, a integração não acontecerá.

Além disso, no final das configurações do seu formulário, você precisa inserir esse código:

```
<div style="display:none;">
[text identificador "SEU IDENTIFICADOR"]
[text c_utmz id:cookieutmz ""]
</div>
<script type="text/javascript">
function read_cookie(a){var b=a+"=";var c=document.cookie.split(";");for(var d=0;d<c.length;d++){var e=c[d];while(e.charAt(0)==" ")e=e.substring(1,e.length);if(e.indexOf(b)==0){return e.substring(b.length,e.length)}}return null}try{document.getElementById("cookieutmz").value=read_cookie("__utmz")}catch(err){}
</script>
```

Veja um exemplo de formulário completo (fique a vontade para copiar, só não esqueça de trocar o identificador):

```
<p>Seu nome (obrigatório)<br />
    [text* your-name] </p>

<p>Seu e-mail (obrigatório)<br />
    [email* email] </p>

<p>Assunto<br />
    [text your-subject] </p>

<p>Sua mensagem<br />
    [textarea your-message] </p>

<p>[submit "Enviar"]</p>

<div style="display:none;">
[text identificador "SEU IDENTIFICADOR"]
[text c_utmz id:cookieutmz ""]
</div>
<script type="text/javascript">
function read_cookie(a){var b=a+"=";var c=document.cookie.split(";");for(var d=0;d<c.length;d++){var e=c[d];while(e.charAt(0)==" ")e=e.substring(1,e.length);if(e.indexOf(b)==0){return e.substring(b.length,e.length)}}return null}try{document.getElementById("cookieutmz").value=read_cookie("__utmz")}catch(err){}
</script>
```

Depois de criar seu formulário, salve-o e insira-o na página desejada. A integração já estará funcionando.  
