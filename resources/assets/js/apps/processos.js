const appName = 'vue-processos'

if (jQuery("#" + appName).length > 0) {
    const app = new Vue({
        el: '#'+appName,

        data: {
            tables: {
                processos: [],

                acoes: [],

                tribunais: [],

                juizes: [],

                procuradores: [],

                assessores: [],

                estagiarios: [],

                meios: [],

                tags: [],
            },

            pesquisa: '',

            refreshing: false,

            filler: false,

            typeTimeout: null,

            advancedFilter: false,

            modalMode: 'filter',

            form: {
                id: null,
                numero_judicial: null,
                numero_alerj: null,
                tribunal_id: null,
                vara: null,
                data_distribuicao: null,
                data_distribuicao: null,
                acao_id: null,
                juiz_id: null,
                autor: null,
                relator_id: null,
                reu: null,
                procurador_id: null,
                estagiario_id: null,
                assessor_id: null,
                tipo_meio_id: null,
                objeto: null,
                merito: null,
                liminar: null,
                apensos_obs: null,
                recurso: null,
                observacao: null,
                data_arquivamento: null,
                data_arquivamento: null,
                observacao_arquivamento: null,
                tags: [],
            }
        },

        methods: {
            refresh() {
                me = this

                me.refreshing = true

                axios.get('/', {
                    params: {
                        search: this.pesquisa,
                            advancedFilter: this.advancedFilter,
                        filter: this.form
                    }
                })
                .then(function(response) {
                    me.tables.processos = response.data

                    me.refreshing = false
                })
                .catch(function(error) {
                    console.log(error)

                    me.tables.processos = []

                    me.refreshing = false
                })
            },

            typeKeyUp() {
                clearTimeout(this.timeout)

                me = this

                this.timeout = setTimeout(function () {
                    me.refresh()
                }, 500)
            },

            clearSearch() {
                this.pesquisa = ''

                this.refresh()
            },

            filter() {
                this.advancedFilter = true

                this.refresh()
            },

            turnAdvancedFilterOff() {
                this.advancedFilter = false

                this.refresh()
            },

            refreshTable: function (table) {
                axios.get('/'+table)
                    .then(function(response) {
                        me.tables[table] = response.data
                    })
                    .catch(function(error) {
                        console.log(error)

                        me.tables[table] = []
                    })
            },
        },

        mounted() {
            this.refresh()

            this.refreshTable('acoes')

            this.refreshTable('tribunais')

            this.refreshTable('juizes')

            this.refreshTable('procuradores')

            this.refreshTable('assessores')

            this.refreshTable('estagiarios')

            this.refreshTable('meios')

            this.refreshTable('tags')
        },
    })
}

