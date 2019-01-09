<script src="<?=base_url()?>assets/vue/vue.min.js"></script>
<script src="https://unpkg.com/marked@0.3.6"></script>
<script src="https://unpkg.com/lodash@4.16.0"></script>
<div class="page-content-wrapper">
  <div class="page-content">
  <div id="editor">
    <textarea :value="input" @input="update"></textarea>
    <div v-html="compiledMarkdown"></div>
  </div>
</div>
</div>
  <script>
    new Vue({
      el: '#editor',
      data: {
        input: '# hello'
      },
      computed: {
        compiledMarkdown: function () {
          return marked(this.input, { sanitize: true })
        }
      },
      methods: {
        update: _.debounce(function (e) {
          this.input = e.target.value
        }, 300)
      }
    })
  </script>
