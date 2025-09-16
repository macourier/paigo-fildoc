import React from 'react';

interface SubscriptionCardProps {
  plan: string;
  bulletinsIncluded: number;
  bulletinsUsed: number;
  nextBillingDate: string;
  price: number;
  currency: string;
}

const SubscriptionCard: React.FC<SubscriptionCardProps> = ({
  plan,
  bulletinsIncluded,
  bulletinsUsed,
  nextBillingDate,
  price,
  currency,
}) => {
  return (
    <div className="p-4 bg-white rounded shadow-md">
      <h3 className="text-lg font-semibold mb-2">Subscription Plan: {plan}</h3>
      <p className="text-gray-700">Bulletins Included: {bulletinsIncluded}</p>
      <p className="text-gray-700">Bulletins Used: {bulletinsUsed}</p>
      <p className="text-gray-700">Next Billing Date: {nextBillingDate}</p>
      <p className="text-gray-700">
        Price: {price} {currency}
      </p>
    </div>
  );
};

export default SubscriptionCard;
