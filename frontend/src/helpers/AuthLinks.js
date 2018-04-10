/**
 * Build menus and display links by account granted permissions.
 * Version: 1.0
 */

const BuildEmployeeLinks = authorities =>
{
    authorities = cleanAuthorities(authorities);
    const userLinks = [];

    for(let key in Links)
    {
        const link = Links[key];
        hasAuthority(authorities, link);
        if(link.grantFor.length === 0 || hasAuthority(authorities, link)) {

            if(link.links) 
            {
                const subGroupLinks = [];    
                for(let subKey in link.links) {
                    const subLink = link.links[subKey];
                    subGroupLinks.push(subLink);
                }

                let subGroup = { 
                    name: link.name,
                    isExpanded: true,
                    links: subGroupLinks
                }   

                userLinks.push(subGroup);
            }
            else {
                userLinks.push(link);
            }
        }
    }

    console.log(userLinks);

    return userLinks;
};

/** Returns true if user has permission to access the link. */
function hasAuthority(authorities, link) {
    return link.grantFor.every( autho => authorities.includes(autho) );
}

/** Extract authorities names. */
function cleanAuthorities(authorities) {
    return authorities.map(a => a.authority);
}

export const Links = 
{
    home: { 
        key: "/", 
        name: "Página inicial", 
        link: "/", 
        grantFor: [] 
    },
    triagemInicial: { 
        key: "", 
        name: "Triagem inicial", 
        link: "/assist", 
        grantFor: ["TRIAGEM_INICIAL"] 
    },
    assistidos: { 
        key: "", 
        name: "Assistidos", 
        link: "", 
        grantFor: ["GERENCIAR_ASSISTIDO"] 
    },
    processos: { 
        key: "", 
        name: "Processos", 
        link: "", 
        grantFor: ["GERENCIAR_PROCESSO"] 
    },
    registrarAtividade: { 
        key: "", 
        name: "Registrar atividade", 
        link: "", 
        grantFor: ["REGISTRAR_ATIVIDADE"] 
    },
    
    gerenciarFuncionarios:
    {
        name: "Gerenciar Funcionários",
        grantFor: ["GERENCIAR_FUNCIONARIO"],
        links: 
        {
            consultar: { 
                key: "/employee", 
                name: "Consultar",
                link: "/employee"
            },
            cadastrar: { 
                key: "/employee/new", 
                name: "Cadastrar", 
                link: "/employee/new"
            },
            ultimasAtividades: { 
                key: "", 
                name: "Últimas atividades", 
                link: ""
            }
        }
    },

    relatorios:
    {
        name: "Relatórios",
        grantFor: ["GERAR_RELATORIO_FUNCIONARIO"],
        links: 
        {
            atividades: { 
                key: "", 
                name: "Atividades", 
                link: ""
            },
            processos: { 
                key: "", 
                name: "Processos", 
                link: ""
            }
        }
    }
};

export default BuildEmployeeLinks;