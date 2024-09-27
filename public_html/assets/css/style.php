  <?php
  /*** set the content type header ***/
  /*** Without this header, it won't work ***/
  header("Content-type: text/css");
  ?>

  /* Reset CSS */
  html,
  body,
  div,
  span,
  applet,
  object,
  iframe,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  p,
  blockquote,
  pre,
  a,
  abbr,
  acronym,
  address,
  big,
  cite,
  code,
  del,
  dfn,
  em,
  img,
  ins,
  kbd,
  q,
  s,
  samp,
  small,
  strike,
  strong,
  sub,
  sup,
  tt,
  var,
  b,
  u,
  i,
  center,
  dl,
  dt,
  dd,
  ol,
  ul,
  li,
  fieldset,
  form,
  label,
  legend,
  table,
  caption,
  tbody,
  tfoot,
  thead,
  tr,
  th,
  td,
  article,
  aside,
  canvas,
  details,
  embed,
  figure,
  figcaption,
  footer,
  header,
  hgroup,
  menu,
  nav,
  output,
  ruby,
  section,
  summary,
  time,
  mark,
  audio,
  video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }

  /* HTML5 display-role reset for older browsers */
  article,
  aside,
  details,
  figcaption,
  figure,
  footer,
  header,
  hgroup,
  menu,
  nav,
  section {
    display: block;
  }

  body {
    line-height: 1;
  }

  ol,
  ul {
    list-style: none;
  }

  blockquote,
  q {
    quotes: none;
  }

  blockquote:before,
  blockquote:after,
  q:before,
  q:after {
    content: '';
    content: none;
  }

  table {
    border-collapse: collapse;
    border-spacing: 0;
  }

  html,
  body {
    height: 100%;
    margin: 0;
  }

  /* váriaveis */
  :root {
    --corBorda: #ccc;
    --corBox: #f0f0f0;
    /* cor do background está em bg-dark, utilizando lib bootstrap */
  }

  /* sessão login */
  .login-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    /* Garante que ocupe toda a altura da viewport */
  }

  .login-box {
    font-size: 10px;
    position: relative;
    /* Ajusta o posicionamento da caixa de login */
    width: 25rem;
    height: 20rem;
    border-width: 1px;
    border-radius: 8%;
    border-style: solid;
    border-color: var(--corBorda);
    padding: 20px;
    background-color: var(--corBox);
    /* Garante que o fundo da caixa de login seja branco e visível */

    /* Adicionando flexbox */
    display: flex;
    flex-direction: column;
    /* Organiza os itens em uma coluna */
    justify-content: center;
    /* Centraliza verticalmente */
    align-items: center;
    /* Centraliza horizontalmente */
    text-align: center;
    /* Centraliza o texto dentro dos itens */
  }

  .login-box input {
    display: flex;
    flex-direction: column;
    flex-wrap: wrap;
    font-size: 1rem;
    margin: 0 auto;
    width: 12rem;
    height: 2rem;
    margin-top: 8px;
    border: solid 1px var(--corBorda);
    border-radius: 10px;
    text-align: center;
  }

  .login-box ::placeholder {
    text-align: center;
    font-size: 1rem;
  }

  .login-section .btn {
    border-color: var(--corBorda);
    border-radius: 10px;
    margin-top: 8px;
    width: 9rem;
    height: 2.5rem;
    padding: 5px 10px;
    font-size: 9px;
    font-size: 1rem;
  }

  /* sessão cadastrar */

  .cadastrar-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .cadastrar-box {
    font-size: 10px;
    position: relative;
    /* Ajusta o posicionamento da caixa de login */
    width: 25rem;
    height: 20rem;
    border-width: 1px;
    border-radius: 8%;
    border-style: solid;
    border-color: var(--corBorda);
    padding: 20px;
    background-color: var(--corBox);

    /* Adicionando flexbox */
    display: flex;
    flex-direction: column;
    /* Organiza os itens em uma coluna */
    justify-content: center;
    /* Centraliza verticalmente */
    align-items: center;
    /* Centraliza horizontalmente */
    text-align: center;
    /* Centraliza o texto dentro dos itens */
  }

  .cadastrar-box input {
    display: flex;
    font-size: 1rem;
    flex-direction: column;
    flex-wrap: wrap;
    margin: 0 auto;
    width: 12rem;
    height: 2rem;
    margin-top: 8px;
    text-align: center;
    border: solid 1px var(--corBorda);
    border-radius: 10px;
  }

  .cadastrar-box ::placeholder {
    text-align: center;
    font-size: 1rem;
  }

  .cadastrar-section .btn {
    border-color: #ccc;
    border-radius: 10px;
    margin-top: 8px;
    width: 9rem;
    height: 2.5rem;
    padding: 5px 10px;
    font-size: 9px;
    font-size: 1rem;
  }

  /* sess ão painel.php */

  .painel-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .bem-vindo {
    font-size: 1.5rem;
    position: relative;
    width: auto;
    height: 40rem;
    border-width: 1px;
    border-radius: 8%;
    border-style: solid;
    border-color: var(--corBorda);
    padding: 20px;
    background-color: var(--corBox);
    gap: 1rem;

    /* flexbox */
    display: flex;
    flex-direction: column;
    /* organiza os itens em uma coluna */
    justify-content: flex-start;
    /* centraliza no meio */
    align-items: center;
    /* centraliza horizontalmente */
    text-align: center;
    /* alinha o texto ao centro */
  }

  .icons {
    align-self: flex-end;
    margin-top: auto;
  }

  .icons :nth-child(4) {
    margin-right: -4px;
  }

  .icon {
    width: 20px;
    height: 20px;
    margin-left: auto;
  }

  .linhaMaiorIndependente {
    width: 46rem;
  }

  .linha {
    width: 46rem;
  }

  /* sessão tabela */

  .table {
    font-size: 16px;
  }

  .janelaCadastrar {
    display: none;
  }

  .janelaCadastrarAtivo {
    font-size: 14px;
    position: absolute;
    width: 40rem;
    text-align: left;

    z-index: 1000;
    height: auto;
    border-width: 1px;
    border-radius: 8%;
    border-style: solid;
    border-color: var(--corBorda);
    padding: 20px;
    background-color: var(--corBox);
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
  }

  .janelaCadastrarAtivo input {
    font-size: 1rem;
    width: 100%;
    margin: 5px 0 12px 5px;
    border: solid 1px var(--corBorda);
    border-radius: 10px;
  }

  .btns {
    text-align: center;
    margin-top: 15px;
  }

  .acoes-tab {
    display: flex;
    flex-direction: row;
    gap: .5rem;
  }

  .pararAnimacao {
;
    transform: scale(1) !important; /* Mantém o tamanho máximo */
    opacity: 1 !important; /* Mantém a opacidade total */
  }

