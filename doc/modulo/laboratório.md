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
  usuario ||--|| cad_empresas : "1 -> 1"
  cad_empresas ||--|| cad_atividades : "1 -> 1"
  cad_empresas ||--|| cad_contratos : "1 -> x"
  dev_plano ||--|| cad_contratos : "1 -> 1"
  usuario ||--|{ cad_cartoes : "1 -> x"
  usuario ||--|{ enderecos : "1 -> x"
  dev_menus ||--|{ dev_submenus : "1 -> x"
    
  dev_plano_tipos ||--|{ dev_plano "1 -> x"
  dev_plano_precos ||--|| dev_plano "1 -> x"
  dev_plano ||--|{ dev_plano_precos "1 -> x"
  dev_plano ||--|{ dev_plano_detalhes "1 -> x"
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
    bigint empresa_id FK "fk_usuario#cad_empresas#id"
  }
  cad_empresas {
    bigint id PK "Chave Primaria"
    bigint atividade_id PK "fk_cad_empresas#atividade#id"
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
```
```mermaid
erDiagram
  cad_atividades {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
  }
  dev_menus {
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
  dev_submenus {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    string link
    bigint menu_id FK "fk_submenus#menus#id"
  }
  dev_plano_tipos {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
  }
```
```mermaid
erDiagram
  dev_plano {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint plano_tipo_id FK "fk_plano#plano_tipos#id"
  }
  dev_plano_detalhes {
    bigint id PK "Chave Primaria"
    string nome
    enum ativo "Sim|Não"
    bigint plano_id FK "fk_plano_detalhes#plano#id"
    int ordem
  }
  dev_plano_precos {
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
  cad_contratos {
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