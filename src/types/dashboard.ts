export interface PayslipStats {
  total_this_month: number;
  total_all_time: number;
}

export interface EmployeeStats {
  active_this_month: number;
  total_employees: number;
}

export interface Suggestion {
  label: string;
  action: string;
  payload: any;
  thread_id?: string;
}

export interface SubscriptionInfo {
  plan: string;
  bulletins_included: number;
  bulletins_used: number;
  next_billing_date: string;
  price: number;
  currency: string;
}
