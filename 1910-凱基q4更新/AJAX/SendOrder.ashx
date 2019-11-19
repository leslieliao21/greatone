<%@ WebHandler Language="C#" Class="SendOrder" %>

using System;
using System.Web;
using log4net;
using log4net.Config;

public class SendOrder : IHttpHandler
{

    static string Path = System.Web.HttpContext.Current.Server.MapPath(@"~/Configuration/log4net.config");
    System.IO.FileInfo _FileInfo = new System.IO.FileInfo(Path);
    private static log4net.ILog logger = log4net.LogManager.GetLogger(System.Reflection.MethodBase.GetCurrentMethod().DeclaringType);
    public void ProcessRequest(HttpContext context)
    {
        XmlConfigurator.Configure(_FileInfo);
        context.Response.ContentType = "application/json";
        context.Response.Charset = "BIG5";
        string Postjson = System.Web.HttpUtility.UrlDecode(new System.IO.StreamReader(context.Request.InputStream).ReadToEnd());
        string FundId = Postjson.Split('&')[0].Split('=')[1];
        string Name = Postjson.Split('&')[1].Split('=')[1];
        string Mobile = Postjson.Split('&')[2].Split('=')[1];
        string Email = Postjson.Split('&')[3].Split('=')[1];
        string IsCheck = Postjson.Split('&')[4].Split('=')[1];
        ActionResponse<string> Result = this.CreateUserData(ref FundId, ref Name, ref Mobile, ref Email, ref IsCheck);
        string ReturnJson = Newtonsoft.Json.JsonConvert.SerializeObject(Result);
        context.Response.Write(ReturnJson);
    }
    private ActionResponse<string> CreateUserData(ref string FundId, ref string Name, ref string Mobile, ref string Email, ref string IsCkeck)
    {
        ActionResponse<string> Result = new ActionResponse<string>();
        bool CheckMobileFormatResult = this.CheckMobileFormat(ref Mobile);
        if (CheckMobileFormatResult == false)
        {
            Result.IsSuccess = false;
            Result.Message = "您輸入的手機格式不正確";
            return Result;
        }
        bool CheckEmailFormatResult = this.CheckEmailFormat(ref Email);
        if (CheckEmailFormatResult == false)
        {
            Result.IsSuccess = false;
            Result.Message = "您輸入的 e-mail 格式不正確";
            return Result;
        }
        bool CheckAccessPrivacyResult = this.CheckAccessPrivacy(ref IsCkeck);
        if (CheckAccessPrivacyResult == false)
        {
            Result.IsSuccess = false;
            Result.Message = "請您閱讀並同意接受貴公司客戶資料保密措施聲明及隱私權保護政策";
            return Result;
        }
        DM_WEB_EC_FOCUSFUND _DM_WEB_EC_FOCUSFUND = new DM_WEB_EC_FOCUSFUND();
        this.CreateInsertModel(ref _DM_WEB_EC_FOCUSFUND, ref FundId, ref Name, ref Mobile, ref Email, ref CheckAccessPrivacyResult);
        this.CallApi(ref _DM_WEB_EC_FOCUSFUND, ref Result);
        return Result;
    }
    public bool IsReusable
    {
        get
        {
            return false;
        }
    }
    private void CallApi(ref DM_WEB_EC_FOCUSFUND _DM_WEB_EC_FOCUSFUND, ref ActionResponse<string>Result)
    {
        FocusFundService _FocusFundService = new FocusFundService();
        try
        {
            Result = _FocusFundService.CreateWEB_EC_FOCUSFUND(_DM_WEB_EC_FOCUSFUND);
        }
        catch(Exception ex)
        {
            logger.Error(ex.ToString());
        }
    }
    private void CreateInsertModel(ref DM_WEB_EC_FOCUSFUND _DM_WEB_EC_FOCUSFUND,
        ref string FundId, ref string Name, ref string Mobile, ref string Email, ref bool IsCkeck)
    {
        _DM_WEB_EC_FOCUSFUND.AccessPrivacy = IsCkeck;
        _DM_WEB_EC_FOCUSFUND.Email = Email;
        _DM_WEB_EC_FOCUSFUND.InterestFundId = FundId;
        _DM_WEB_EC_FOCUSFUND.Mobile = Mobile;
        _DM_WEB_EC_FOCUSFUND.Name = Name;
    }
    private bool CheckAccessPrivacy(ref string IsCheck)
    {
        return IsCheck == "1" ? true : false;
    }
    private bool CheckEmailFormat(ref string Email)
    {
        if (string.IsNullOrEmpty(Email) == false)
        {
            string MailRule = @"^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$";
            System.Text.RegularExpressions.Regex Regex = new System.Text.RegularExpressions.Regex(MailRule);
            System.Text.RegularExpressions.Match _Match = Regex.Match(Email);
            bool Vaile = _Match.Success;
            return Vaile;
        }
        else
        {
            return true;
        }
    }
    private bool CheckMobileFormat(ref string Mobile)
    {
        string Rule = @"^09\d{2}\d{3}-?\d{3}$";
        System.Text.RegularExpressions.Regex Regex = new System.Text.RegularExpressions.Regex(Rule);
        System.Text.RegularExpressions.Match _Match = Regex.Match(Mobile);
        bool Vaile = _Match.Success;
        return Vaile;
    }

}