import React from 'react';
import { useQuery } from '@tanstack/react-query';
import { useChatStore } from './ChatWidget';
import StatCard from './StatCard';
import SuggestionCard from './SuggestionCard';
import SubscriptionCard from './SubscriptionCard';
import Toast from './Toast';

import type { PayslipStats, EmployeeStats, SubscriptionInfo, Suggestion } from '../types/dashboard';

const fetcher = (url: string, token: string) =>
  fetch(url, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  }).then((res) => {
    if (!res.ok) throw new Error('Erreur réseau');
    return res.json();
  });

const Dashboard: React.FC = () => {
  const token = localStorage.getItem('authToken') || '';
  const userRole = localStorage.getItem('userRole') || 'user';
  const { setCurrentThreadId, openChat } = useChatStore();

  const {
    data: payslipStats,
    isLoading: loadingPayslips,
    error: errorPayslips,
  } = useQuery<PayslipStats>({
    queryKey: ['stats', 'payslips'],
    queryFn: () => fetcher('/stats/payslips', token),
    refetchInterval: 60000,
  });

  const {
    data: employeeStats,
    isLoading: loadingEmployees,
    error: errorEmployees,
  } = useQuery<EmployeeStats>({
    queryKey: ['stats', 'employees'],
    queryFn: () => fetcher('/stats/employees', token),
    refetchInterval: 60000,
  });

  const {
    data: suggestions,
    isLoading: loadingSuggestions,
    error: errorSuggestions,
  } = useQuery<Suggestion[]>({
    queryKey: ['ai', 'suggestions'],
    queryFn: () => fetcher('/ai/suggestions', token),
    refetchInterval: 60000,
  });

  const {
    data: subscription,
    isLoading: loadingSubscription,
    error: errorSubscription,
  } = useQuery<SubscriptionInfo>({
    queryKey: ['account', 'subscription'],
    queryFn: () => fetcher('/account/subscription', token),
    refetchInterval: 60000,
  });

  const handleOpenChatWithSuggestion = (suggestion: Suggestion) => {
    setCurrentThreadId(suggestion.thread_id || 'default_thread');
    openChat();
  };

  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
      {errorPayslips && <Toast type="error" message="Erreur chargement bulletins" />}
      {errorEmployees && <Toast type="error" message="Erreur chargement salariés" />}
      {errorSuggestions && <Toast type="error" message="Erreur chargement suggestions" />}
      {errorSubscription && <Toast type="error" message="Erreur chargement abonnement" />}

      <StatCard
        title="Bulletins générés"
        value={
          loadingPayslips
            ? '...'
            : userRole === 'admin'
            ? `${payslipStats?.total_this_month ?? 0} ce mois, ${payslipStats?.total_all_time ?? 0} au total`
            : 'Données masquées'
        }
      />

      <StatCard
        title="Salariés actifs"
        value={
          loadingEmployees
            ? '...'
            : userRole === 'admin'
            ? employeeStats?.active_this_month ?? 0
            : 'Données masquées'
        }
      />

      <div className="col-span-1 md:col-span-2 lg:col-span-1">
        <h2 className="text-lg font-semibold mb-2">Suggestions IA récentes</h2>
        {loadingSuggestions ? (
          <p>Chargement...</p>
        ) : (
          suggestions?.slice(0, 3).map((s, idx) => (
            <SuggestionCard
              key={idx}
              label={s.label}
              action={s.action}
              payload={s.payload}
              onClick={() => handleOpenChatWithSuggestion(s)}
            />
          ))
        )}
      </div>

      <SubscriptionCard
        plan={subscription?.plan ?? 'N/A'}
        bulletinsIncluded={subscription?.bulletins_included ?? 0}
        bulletinsUsed={subscription?.bulletins_used ?? 0}
        nextBillingDate={subscription?.next_billing_date ?? 'N/A'}
        price={subscription?.price ?? 0}
        currency={subscription?.currency ?? ''}
      />
    </div>
  );
};

export default Dashboard;
