<?php

/* @Installation/_systemCheckLegend.twig */
class __TwigTemplate_6086bf761fdc547e5abd313e52246185400802c20fb0c307a802941dfbf98150 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"system-check-legend\">
    <h2>";
        // line 2
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_Legend")), "html", null, true);
        echo "</h2>

    <p>
        <span class=\"icon-ok\"></span>
        ";
        // line 6
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Ok")), "html", null, true);
        echo "
    </p>
    <p>
        <span class=\"icon-warning\"></span>
        ";
        // line 10
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Warning")), "html", null, true);
        echo ": ";
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckWarning")), "html", null, true);
        echo "
    </p>
    <p>
        <span class=\"icon-error\"></span>
        ";
        // line 14
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_Error")), "html", null, true);
        echo ": ";
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheckError")), "html", null, true);
        echo "
    </p>
</div>

<p class=\"next-step\">
    <a href=\"";
        // line 19
        echo \Piwik\piwik_escape_filter($this->env, (isset($context["url"]) ? $context["url"] : $this->getContext($context, "url")), "html", null, true);
        echo "\">";
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("General_RefreshPage")), "html", null, true);
        echo " &raquo;</a>
</p>
";
    }

    public function getTemplateName()
    {
        return "@Installation/_systemCheckLegend.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 19,  45 => 14,  36 => 10,  29 => 6,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"system-check-legend\">
    <h2>{{ 'Installation_Legend'|translate }}</h2>

    <p>
        <span class=\"icon-ok\"></span>
        {{ 'General_Ok'|translate }}
    </p>
    <p>
        <span class=\"icon-warning\"></span>
        {{ 'General_Warning'|translate }}: {{ 'Installation_SystemCheckWarning'|translate }}
    </p>
    <p>
        <span class=\"icon-error\"></span>
        {{ 'General_Error'|translate }}: {{ 'Installation_SystemCheckError'|translate }}
    </p>
</div>

<p class=\"next-step\">
    <a href=\"{{ url }}\">{{ 'General_RefreshPage'|translate }} &raquo;</a>
</p>
", "@Installation/_systemCheckLegend.twig", "/home/webpages/lima-city/fruehlingsseminar/zeitgeschehen/anal/plugins/Installation/templates/_systemCheckLegend.twig");
    }
}
