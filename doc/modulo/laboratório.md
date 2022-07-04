# Diagrama de Entidade Relacional - Adminstrador

> Documentação [mermaid](https://mermaid-js.github.io/mermaid/#/)

## Configurar relacionamento
---
| Value (left) | Value (right) | Meaning |
|--- |--- |--- |
| \|o | o\| | Zero or one |
| \|\| | \|\| | Exactly one |
| }o | o{ | Zero or more (no upper limit) |
| }\| | \|{ | One or more (no upper limit) |
---
## Database
---
```mermaid
flowchart LR
    A[(Staartdev DB)]
```
---
## Entidade Relacional
---
```mermaid
erDiagram
  usuario ||--|| empresas : "1 -> 1"
  usuario ||--|| projetos : "1 -> 1"
  empresas ||--|| atividades : "1 -> 1"
  empresas ||--|{ contratos : "1 -> x"
  usuario ||--|{ cartoes : "1 -> x"
  usuario ||--|{ enderecos : "1 -> x"
  plano ||--|{ contratos : "1 -> x"
  menus ||--|{ submenus : "1 -> x"
  modulos ||--|{ modulos_menus : "1 -> x"
  menus ||--|{ modulos_menus : "1 -> x"
  projetos ||--|{ pages "1 -> x"
  projetos ||--|{ plano "1 -> x"
  plano_tipos ||--|{ plano "1 -> x"
  projetos ||--|{ plano "1 -> x"
  plano ||--|{ plano_detalhes "1 -> x"
  plano ||--|{ plano_precos "1 -> x"
```
---
## Tabelas
---
```mermaid
erDiagram
  usuario {
    bigint id PK "Chave Primaria"
    string nome
    string email
    string senha
    string tipo
    string avatar
    string cpf_cnpj
    enum ativo "Sim|Não"
    bigint empresa_id FK "fk_usuario#empresas#id"
    bigint projeto_id FK "fk_usuario#projetos#id"
  }
  empresas {
    bigint id PK "Chave Primaria"
    bigint atividade_id PK "fk_empresas#atividade#id"
    string razao_social
    string nome_fantasia
    string cep
    string endereco
    string numero
    string bairro
    string complemento
    string cidade
    string uf
    string celular
    date dt_experiencia
    enum ativo "Sim|Não"
  }
  projetos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    string site
    string dominio
  }
```
```mermaid
erDiagram
  atividades {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
  }
  modulos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
  }
  menus {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    string link
    string icone
    int ordem
  }
```
```mermaid
erDiagram
  submenus {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    string link
    bigint menu_id FK "fk_submenus#menus#id"
  }
  modulos_menus {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint modulo_id FK "fk_modulos_menus#modulos#id"
    bigint menu_id FK "fk_modulos_menus#menus#id"
  }
  plano_tipos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
  }
```
```mermaid
erDiagram
  plano {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint plano_tipo_id FK "fk_plano#plano_tipos#id"
    bigint projeto_id FK "fk_plano#projetos#id"
  }
  plano_detalhes {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint plano_id FK "fk_plano_detalhes#plano#id"
    bigint modulo_id FK "fk_plano_detalhes#modulos#id"
    int ordem
  }
  plano_precos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint plano_id FK "fk_plano_precos#plano#id"
    decimal preco
  }
```
```mermaid
erDiagram
  pages {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    enum tipo "|"
    string param
    string value
    string valueImg
    bigint projeto_id FK "fk_pages#projetos#id"
  }
  cartoes {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    enum tipo "Cartão de Crédito|Cartão de Débito"
    decimal numero
    date dt_exoiracao
    decimal cvv
    enum bandeira "Visa|Master Card|Elo|American Express"
    bigint usuario_id FK "fk_cartoes#usuario#id"    
  }
  contratos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    date dt_contrato
    bigint plano_id
    bigint empresa_id
    enum status "Aberto|Pago|Cancelado"
    date dt_fim
  }
```
```mermaid
erDiagram
  enderecos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    string rua
    string numero
    string bairro
    string complemento
    string cep
    string estado
    string cidade
    string telefone
    enum principal "Sim|Não"
    bigint usuario_id FK "fk_enderecos#usuario#id"
  }
```
---