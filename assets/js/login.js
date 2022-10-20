$(function() {
  // 点击“去注册账号”的链接
  $('#link_reg').on('click', function() {
    $('.login-box').hide() // 隐藏登录框 类名选择器
    $('.reg-box').show() // 显示注册框
  })

  // 点击“去登录”的链接
  $('#link_login').on('click', function() {
    $('.login-box').show() // 显示登录框
    $('.reg-box').hide() // 隐藏注册框
  })

  // 从 layui 中获取 form 对象
  var form = layui.form
  var layer = layui.layer // 从 layui 中获取 layer 对象
  // 通过 form.verify() 函数自定义校验规则
  form.verify({
    // 自定义了一个叫做 pwd 校验规则
    pwd: [/^[\S]{6,12}$/, '密码必须6到12位，且不能出现空格'],
    // 校验两次密码是否一致的规则
    repwd: function(value) {
      // 通过形参拿到的是确认密码框中的内容
      // 还需要拿到密码框中的内容
      // 然后进行一次等于的判断
      // 如果判断失败,则return一个提示消息即可
      var pwd = $('.reg-box [name=password]').val()
      if (pwd !== value) {
        return '两次密码不一致！'
      }
    }
  })

  
})
